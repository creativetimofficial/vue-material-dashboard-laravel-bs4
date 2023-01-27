<?php

namespace App\Jobs;

use App\Hotel;
use App\Reservations;
use App\Accommodations;
use App\ReservationRooms;
use App\Dates;
use App\Occupations;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Taxes;

class SyncAttReservationZio implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $reservations_updated = ["reservations" => []];
        $date = new \DateTime();
        $date->modify('-15 minutes');
        $formatted_date = $date->format('Y-m-d H:i:s');
        $reservations = Reservations::where('updated_at', '>=', $formatted_date)->get();
        $hoteisManuais = [487, 505, 506, 508, 539, 533, 534, 531, 535, 537, 540, 542, 543, 544];
        foreach ($reservations as $reservation) {
            $hotel = Hotel::find($reservation->hotel_id);
            if (in_array($hotel->id, $hoteisManuais)) {
                continue;
            }
            $date = Dates::where('hotel_id', '=', $hotel->id)->first();
            if($hotel->connetion_type === 'Offline') {
                    continue;
            }
            if ($this->validateZioIdOnOccupation($reservation) == count($reservation->reservationRooms) && $hotel->omnibees_id !== null) {
                $reservationRooms = $reservation->reservationRooms;
                $explode_name = explode(' ', $reservation['client_name'], 2);
                $client_name = ['Zarpo', 'Tech'];
                if (is_array($explode_name)) {
                    $client_name = count($explode_name) > 1 ? [$explode_name[0], $explode_name[1]] : ['Zarpo', 'Tech'];
                }
                $reservation = [
                    'hotel_magento_id' => $hotel['magento_id'],
                    'magento_id' => strval($reservation['magento_id']),
                    'booker_id' =>$reservation['id'],
                    'check_in' => $reservationRooms[0]['check_in'],
                    'check_out' => $reservationRooms[0]['check_out'],
                    'order_date' => $reservation['order_date'],
                    'state' => $reservation['status'] == 'complete' || $reservation['status'] == 'Booked' || $reservation['status'] == 'payment_review' ? 'Booked' : 'Cancelled',
                    'first_name' => $client_name[0],
                    'last_name' => $client_name[1],
                    'address1' => 'Av Ipiranga, 104',
                    'address2' => 'República',
                    'country_code' => 'Brasil',
                    'city' => 'São Paulo',
                    'zipcode' => '01000970',
                    'phone' => preg_replace("/[^0-9]/", "", $reservation['client_phone']),
                    'email' => $reservation['client_email'],
                    'currency' => $date['currency'],
                    'notes' => $reservation['special_request'],
                    'total_price' => $reservation['total'],
                    'created_at' => date('Y-m-d H:i:s', strtotime($reservation['created_at'])),
                    'updated_at' => date('Y-m-d H:i:s', strtotime($reservation['updated_at']))
                ];
                foreach ($reservationRooms as $reservationRoom) {
                    $reservationRoom['cost_price'] = json_decode($reservationRoom['cost_price'], true);
                    $zio_id = Occupations::withTrashed()->find($reservationRoom['occupation_id'])->zio_sub_room_id;
                    $reservation['rooms'][] = [
                        'booker_id' => $reservationRoom['id'],
                        'subroom_id' => $zio_id,
                        'reservations_id' => $reservationRoom['reservation_id'],
                        'adults' => $reservationRoom['adults'],
                        'children' => $reservationRoom['children'],
                        'children_age' => $this->splitChildrenAge($reservationRoom['children_age']),
                        'check_in' => $reservationRoom['check_in'],
                        'check_out' => $reservationRoom['check_out'],
                        'room_net_price' => $reservationRoom['cost_price']['net_price'],
                        'room_tax' => $this->calculateReservationRoomTaxes($reservationRoom['cost_price']['net_price'], $hotel, $reservationRoom),
                        'used_promotions' => json_encode($reservationRoom['cost_price']['cost_price']['promotions']),
                        'guest_name' => $reservationRoom['responsible'],
                        'created_at' => date('Y-m-d H:i:s', strtotime($reservationRoom['created_at'])),
                        'updated_at' => date('Y-m-d H:i:s', strtotime($reservationRoom['updated_at']))
                    ];
                }
                $reservations_updated['reservations'][] = $reservation;
            }
        }
        //print(json_encode($reservations_updated));
        if (count($reservations_updated)) {
            $response = Http::post('https://zio.zarpo.com.br/api/booker/reservations/create', $reservations_updated);
        }
        // $client = new Client();
        // $response = $client->request('POST', 'https://staging.zio.zarpo.com/api/booker/reservations/create', $reservations_updated);
    }

    protected function validateZioIdOnOccupation($reservation)
    {
        $rooms_checked = 0;
        foreach ($reservation->reservationRooms as $room) {
            if ($room->occupation_id != null) {
                $occ = Occupations::find($room->occupation_id);
                if ($occ->zio_sub_room_id != null) {
                    $rooms_checked+=1;
                }
            }
        }
        return $rooms_checked;
    }

    protected function splitChildrenAge($children_age)
    {
        if ($children_age == 0) {
            return json_encode([]);
        }
        $formatted_date_childen_age = [];
        foreach (explode(",", $children_age) as $age) {
            $formatted_date_childen_age[] = intval($age);
        }
        return json_encode($formatted_date_childen_age);
    }

    protected function calculateReservationRoomTaxes($net_price, $hotel, $reservationRoom)
    {
        $roomAdditionDate = date('Y-m-d', strtotime($reservationRoom['created_at']));
        $hotel_id = $hotel->id;
        $taxes = Taxes::withTrashed()->where('hotel_id', '=', $hotel_id)->get();
        $taxes_value_total = 0;
        $net_price_value_initial = $net_price;
        if ($taxes != null) {
            foreach ($taxes as $taxes) {
                if ($taxe->date_start != null && $taxe->date_end != null) {
                    $array_return = $this->findTaxeValue($taxe->type, $taxe->value, $net_price_value_initial, $taxes_value_total);
                    $net_price_value_initial = $array_return['value_net_price'];
                    $taxes_value_total = $array_return['taxes_value_total'];
                    continue;
                }
                if ($taxe->date_start == null) {
                    if ($roomAdditionDate <= $taxe->date_end) {
                        $array_return = $this->findTaxeValue($taxe->type, $taxe->value, $net_price_value_initial, $taxes_value_total);
                        $net_price_value_initial = $array_return['value_net_price'];
                        $taxes_value_total = $array_return['taxes_value_total'];
                        continue;
                    }
                }
                if ($taxe->date_end == null) {
                    if ($roomAdditionDate >= $taxe->date_start) {
                        $array_return = $this->findTaxeValue($taxe->type, $taxe->value, $net_price_value_initial, $taxes_value_total);
                        $net_price_value_initial = $array_return['value_net_price'];
                        $taxes_value_total = $array_return['taxes_value_total'];
                        continue;
                    }
                }
                if ($roomAdditionDate >= $taxe->date_start && $roomAdditionDate <= $taxe->date_end) {
                    $array_return = $this->findTaxeValue($taxe->type, $taxe->value, $net_price_value_initial, $taxes_value_total);
                    $net_price_value_initial = $array_return['value_net_price'];
                    $taxes_value_total = $array_return['taxes_value_total'];
                    continue;
                }
            }
            return $taxes_value_total;
        } else if ($taxes == null) {
            return $taxes_value_total;
        }
    }

    protected function findTaxeValue($taxe_type, $taxe_value, $net_price, $taxes_value_total)
    {
        if ($taxe_type == "relative") {
            $percentage_increase = 1 + ($taxe_value/100);
            $net_price_before_increase = $net_price/$percentage_increase;
            $taxe_value_applied = ($net_price - $net_price_before_increase);
            $taxes_value_total += $taxe_value_applied;
            $net_price -= $taxe_value_applied;
        }
        if ($taxe_type == "absolute") {
            $taxes_value_total += $taxe_value;
            $net_price -= $taxe_value;
        }
        return [
            'value_net_price' => $net_price,
            'taxes_value_total' => $taxes_value_total
        ];
    }
}
