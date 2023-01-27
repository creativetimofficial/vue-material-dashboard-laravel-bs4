<?php

namespace App\Repository\Eloquent;

use App\Repository\EloquentRepositoryInterface;
use App\Occupations;
use App\Hotel;
use App\Accommodations;
use App\Dates;
use App\Http\Resources\Promotion as PromotionResource;
use App\Http\Resources\Occupation as OccupationResource;
use App\Repository\Eloquent\CalendarRepository;
use App\Repository\Eloquent\PromotionRepository;
use DateTime;
use Illuminate\Support\Facades\Cache;
use Grayloon\Magento\Magento;

class BaseRepository implements EloquentRepositoryInterface
{
    public function getActivePromotions($promotions, $act, $date)
    {
        $actives = array();
        $inactives = array();
        $pending = array();
        $now = $date ? date('Y-m-d', strtotime($date)) : date('Y-m-d');
        $formattedDate = new \DateTime($now);
        foreach ($promotions as $promotion) {
            $start = date('Y-m-d', strtotime($promotion->promotion_start));
            $end = date('Y-m-d', strtotime($promotion->promotion_end));
            $promotion_start = $promotion->promotion_start ? $start : date('Y-m-d');
            $promotion_end = $promotion->promotion_end ? $end : date('Y-m-d', strtotime('+1 year'));
            $blackout_days = json_decode($promotion->blackout_days, true);
            if (date('Y-m-d') >= $promotion_start && date('Y-m-d') <= $promotion_end) { //&& $promotion->status == 'active'
                if ($promotion->week_days != null && count($promotion->week_days) > 0) {
                    if (!in_array($formattedDate->format('N'), $promotion->week_days)) {
                        $inactives[] = $promotion;
                        continue;
                    }
                }
                //check if date is black out
                if ($blackout_days != null) {
                    if (count($blackout_days) > 0) {
                        if (in_array($now, $blackout_days)) {
                            $inactives[] = $promotion;
                            continue;
                        }
                    }
                }
                if ($promotion->period_start && $promotion->period_end) {
                    $period_start = date('Y-m-d', strtotime($promotion->period_start));
                    $period_end = date('Y-m-d', strtotime($promotion->period_end));
                    if ($now >= $period_start && $now <= $period_end) {
                        $actives [] = $promotion;
                    } else {
                        $pending [] = $promotion;
                    }
                } elseif ($promotion->period_start) {
                    $period_start = date('Y-m-d', strtotime($promotion->period_start));
                    if ($now >= $period_start) {
                        $actives [] = $promotion;
                    } else {
                        $pending [] = $promotion;
                    }
                } elseif ($promotion->period_end) {
                    $period_end = date('Y-m-d', strtotime($promotion->period_end));
                    if ($now <= $period_end) {
                        $actives [] = $promotion;
                    } else {
                        $inactives [] = $promotion;
                    }
                } elseif ($promotion->interval_start && $promotion->interval_end) {
                    $interval_start = date('Y-m-d', strtotime("+" . $promotion->interval_start . "day", strtotime(date('Y-m-d'))));
                    $interval_end = date('Y-m-d', strtotime("+" . $promotion->interval_end . "day", strtotime(date('Y-m-d'))));
                    if ($now >= $interval_start && $now <= $interval_end) {
                        $actives [] = $promotion;
                    } else {
                        $pending [] = $promotion;
                    }
                } elseif ($promotion->interval_start) {
                    $interval_start = date('Y-m-d', strtotime("+" . $promotion->interval_start . "day", strtotime(date('Y-m-d'))));
                    if ($now >= $interval_start) {
                        $actives [] = $promotion;
                    } else {
                        $pending [] = $promotion;
                    }
                } elseif ($promotion->interval_end) {
                    $interval_end = date('Y-m-d', strtotime("+" . $promotion->interval_end . "day", strtotime(date('Y-m-d'))));
                    if ($now <= $interval_end) {
                        $actives [] = $promotion;
                    } else {
                        $inactives [] = $promotion;
                    }
                } else {
                    $actives [] = $promotion;
                }
            } else {
                $inactives [] = $promotion;
            }
        }
        $this->setPromotionPending($pending);
        $this->setPromotionInactive($inactives);
        return $act == true ? PromotionResource::collection($actives) : PromotionResource::collection($inactives);
    }

    public function setPromotionInactive($promotions)
    {
        foreach ($promotions as $promotion) {
            $promotion->update(["status" => "inactive"]);
        }
    }
    public function setPromotionPending($promotions)
    {
        foreach ($promotions as $promotion) {
            $promotion->update(["status" => "pending"]);
        }
    }

    public function getAccommodationPromotions($accommodation, $act, $date)
    {
        $accommodation = Accommodations::find($accommodation);
        $hotel = Hotel::find($accommodation->hotel_id);
        $promotions = array();
        foreach ($hotel->promotions as $promotion) {
            $selected = $promotion->accommodations_selected ? $promotion->accommodations_selected: [];
            if (in_array($accommodation->id, $selected)) {
                $promotions[] = $promotion;
            }
        }

        $activePromotions = $this->getActivePromotions($promotions, $act, $date);
        return $act !== null ? $activePromotions : PromotionResource::collection($promotions);
    }

    public function getHotelCalendar(Hotel $hotel)
    {
        $key = '"calendar' . $hotel->id . '"';
        if (Cache::has($key)) {
            return Cache::get($key);
        } else {
            $CalendarRepository = new CalendarRepository();
            return $CalendarRepository->mountCalendar($hotel);
        }
    }

    public function updateHotelCalendar(Hotel $hotel)
    {
        $key = '"calendar' . $hotel->id . '"';
        Cache::forget($key);
        if ($hotel->magento_id) {
            $magento = new Magento();
            $magento->api('integration')->cleanCalendarCache($hotel->magento_id);
        }
    }

    public function validateStay(Hotel $hotel, $checkin, $checkout, $occupation)
    {
        try {
            $calendar = $this->getHotelCalendar($hotel);
            $dates = json_decode(json_encode($calendar['accommodations'][$occupation->accommodations_id]['dates']), true);
            $checkinDate  = new DateTime($checkin);
            $checkoutDate = new DateTime($checkout);
            $difference = $checkinDate->diff($checkoutDate);
            $countDifference = $difference->d;
            $datesInterval = $checkinDate;
            $stringDate = $datesInterval->format('Y-m-d');
            for ($i = 0; $i < $countDifference; $i++) {
                if (!array_key_exists($stringDate, $dates)) {
                    return false;
                }
                $stringDate = date('Y-m-d', strtotime("+1 day", strtotime($stringDate)));
            }
            $min_stay = $calendar['accommodations'][$occupation->accommodations_id]['dates'][$checkin]['min_stay'];
            $close_arrival = $calendar['accommodations'][$occupation->accommodations_id]['dates']
                                [$checkin]['close_arrival'];
            $close_departure = $calendar['accommodations'][$occupation->accommodations_id]['dates']
                                [$checkout]['close_departure'];
            if (!$close_arrival && !$close_departure && $this->validateMinStay($checkin, $checkout, $min_stay)) {
                return $this->validateStockAndStopSales($calendar, $occupation, $checkin, $checkout);
            } else {
                return false;
            }
        } catch (\Exception $exception) {
            return response()->json([
            'status' => 'Error',
            'message' => $exception->getMessage()
            ]);
        }
    }

    public function validateMinStay($checkin, $checkout, $min_stay)
    {
        if (date('Y-m-d', strtotime("+". $min_stay ." day", strtotime($checkin))) <= $checkout) {
            return true;
        } else {
            return false;
        }
    }

    public function validateStockAndStopSales($calendar, $occupation, $checkin, $checkout)
    {
        $date_loop = $checkin;
        while ($date_loop <= $checkout) {
            $stock_total = $calendar['accommodations'][$occupation->accommodations_id]['dates']
                            [$date_loop]['stock_total'];
            $stock_locked = $calendar['accommodations'][$occupation->accommodations_id]['dates']
                            [$date_loop]['stock_locked'];
            $close_departure = $calendar['accommodations'][$occupation->accommodations_id]['dates']
                            [$date_loop]['close_departure'];
            $stock = $stock_total - $stock_locked;

            if ($date_loop == $checkout && !$close_departure) {
                $date_loop = date('Y-m-d', strtotime("+1 day", strtotime($date_loop)));
                continue;
            }
            if ($stock > 0 && !$this->getStopSales($calendar, $occupation->accommodations_id, $date_loop)) {
                $date_loop = date('Y-m-d', strtotime("+1 day", strtotime($date_loop)));
                continue;
            }
            return false;
        }
        return true;
    }

    public function getStopSales($calendar, $accommodations_id, $date)
    {
        return $calendar['accommodations'][$accommodations_id]['dates'][$date]['stop_sales'];
    }

    public function calculatePrices(Hotel $hotel, $checkin, $checkout, $occupation)
    {
        try {
            $calendar = $this->getHotelCalendar($hotel);
            $date = Dates::where("date", "=", $checkin)->firstOrFail();
            $date_loop = $checkin;
            $client_price = 0;
            $net_price = 0;
            $cost_price = [
            "currency" => $date->currency,
            "adults" => $occupation->adults,
            "children" => $occupation->children,
            "dates" => [],
            "promotions" => []
            ];
            $qty = 0;
            while ($date_loop < $checkout) {
                $occupation_data = $calendar['accommodations'][$occupation->accommodations_id]['dates']
                            [$date_loop]['occupations'][$occupation->id];
                $client_price += $occupation_data['client_price'];
                $net_price += $occupation_data['net_price'];
                $cost_price['dates'][$date_loop] = $occupation_data['net_price'];
                $promotions = $this->getAccommodationPromotions($occupation->accommodations_id, true, $date_loop);
                foreach ($promotions as $promotion) {
                    $promotion_value = $promotion->discount_value;
                    $value = $promotion->discount_type === "absolute" ? $promotion_value : $promotion_value . "%";
                    $cost_price['promotions'][$date_loop][] = [
                    "name" => $promotion->name,
                    "discount_value" => $value
                    ];
                }
                $qty +=1;
                $date_loop = date('Y-m-d', strtotime("+1 day", strtotime($date_loop)));
            }
            return [
            'client_price' => ceil(ceil($client_price / $qty) * $qty),
            'net_price' => $net_price,
            'cost_price' => $cost_price
            ];
        } catch (\Exception $exception) {
            return response()->json([
            'status' => 'Error',
            'message' => $exception->getMessage()
            ]);
        }
    }

    public function fetchDatesPromotionCalendar($startDate, $endDate, $weekDays, $blackoutDays)
    {
        $startDate = new \DateTime($startDate);
        $endDate = new \DateTime($endDate.' 23:59:59');
        $period = new \DatePeriod(
            $startDate,
            new \DateInterval('P1D'),
            $endDate
        );
        $allowedDays = $weekDays;
        $resultArray = array();
        foreach ($period as $key => $value) {
            //check if the day of the week is allowed
            if (count($allowedDays) > 0) {
                if (!in_array($value->format('N'), $allowedDays)) {
                    continue;
                }
            }
            //check if date is black out
            if ($blackoutDays != null) {
                if (count($blackoutDays) > 0) {
                    if (in_array($value->format('Y-m-d'), $blackoutDays)) {
                        continue;
                    }
                }
            }
            $resultArray[] = $value->format('Y-m-d');
        }
        return $resultArray;
    }

    public function getAttributeMagento($attribute_code, $allData)
    {
        $magento = new Magento();
        $attributes = $magento->api('integration')->getAttributes(10);
        foreach (json_decode($attributes) as $attribute) {
            if ($attribute->attribute_code  == $attribute_code) {
                if ($allData) {
                    return $attribute;
                } else {
                    return $attribute->attribute_id;
                }
            }
        }
    }

    public function checkHotelMagento($bookerId)
    {
        $filters = [
            'searchCriteria[filterGroups][0][filters][0][field]' => 'idbooker',
            'searchCriteria[filterGroups][0][filters][0][value]' => $bookerId
        ];
        $magento = new Magento();
        $response = $magento->api('integration')->search($filters);
        $response = json_decode($response);
        if (count($response->items) == 0) {
            return false;
        }
        return $response->items[0];
    }

    public function getOccupationByAccommodation(Accommodations $Accommodation)
    {
        $occupations = Occupations::where('accommodations_id', '=', $Accommodation->id)->get();
        return OccupationResource::collection($occupations);
    }


    public function validateMinStayDates($date, $accommodation_id, $min_stay)
    {
        $firstDate = new DateTime($date);
        $datePlusMinStay = new DateTime(date('Y-m-d', strtotime("+".$min_stay." days", strtotime($date))));
        $validatorMinStay = true;

        for ($dateLoop = $firstDate; $dateLoop <= $datePlusMinStay; $dateLoop->modify('+1 day')) {
            $dateformated = $dateLoop->format('Y-m-d');
            $dateInformation = Dates::where("date", "=", $dateformated)
                                    ->where("accommodations_id", "=", $accommodation_id)
                                    ->first();
            if ($dateInformation == null) {
                $validatorMinStay = false;
                break;
            }
            if ($dateLoop == $datePlusMinStay && $dateInformation->close_departure != 0) {
                $validatorMinStay = false;
                break;
            }
            if ($dateLoop != $datePlusMinStay) {
                if ($dateInformation->stop_sales == 1 || $dateInformation->stock_total <= 0 || $dateInformation->close_arrival == 1 || $dateInformation->close_departure == 1) {
                    $validatorMinStay = false;
                    break;
                }
            }
        }
        return $validatorMinStay;
    }
}
