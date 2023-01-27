<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Repository\Eloquent\CalendarRepository;
use Illuminate\Support\Facades\Http;

class SyncCalendarConnect implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $calendar;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $calendar)
    {
        $this->calendar = $calendar;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $calendar = $this->calendar;

        unset($calendar["status"]);
        if ($calendar['accommodations'] != []) {
            $calendar['accommodations'] = $calendar['accommodations']->toArray();
        }
        foreach ($calendar['accommodations'] as $id_accommodation => $accommodation) {
            if ($calendar['accommodations'][$id_accommodation]['dates'] != []) {
                $calendar['accommodations'][$id_accommodation]['dates'] = $calendar['accommodations'][$id_accommodation]['dates']->toArray();
            }
            unset($calendar['accommodations'][$id_accommodation]["magento_id"]);
            unset($calendar['accommodations'][$id_accommodation]["status"]);
            unset($calendar['accommodations'][$id_accommodation]["min_net_price"]);
            foreach ($calendar['accommodations'][$id_accommodation]['dates'] as $key => $date) {
                if ($calendar['accommodations'][$id_accommodation]['dates'][$key]['occupations'] != []) {
                    $calendar['accommodations'][$id_accommodation]['dates'][$key]['occupations'] = $calendar['accommodations'][$id_accommodation]['dates'][$key]['occupations']->toArray();
                }
                unset($calendar['accommodations'][$id_accommodation]['dates'][$key]['min_net_price']);
                unset($calendar['accommodations'][$id_accommodation]['dates'][$key]['min_reference_price']);
                foreach ($calendar['accommodations'][$id_accommodation]['dates'][$key]['occupations'] as $id_occupation => $occupation) {
                    unset($calendar['accommodations'][$id_accommodation]['dates'][$key]['occupations'][$id_occupation]['status']);
                    unset($calendar['accommodations'][$id_accommodation]['dates'][$key]['occupations'][$id_occupation]['net_price']);
                    unset($calendar['accommodations'][$id_accommodation]['dates'][$key]['occupations'][$id_occupation]['reference_price']);
                }
            }
        }

        $calendarConnect = [
            'booker_hotel_id' => $calendar['hotel_id'],
            'hotel_id' => $calendar['hotel_id'],
            'json_calendar' => $calendar,
            
        ];
        
        Http::put('https://api.connect.zarpo.com/calendar', $calendarConnect);
    }
}
