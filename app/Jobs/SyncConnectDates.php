<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Repository\Eloquent\CalendarRepository;
use Illuminate\Support\Facades\Http;

class SyncConnectDates implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $date;
    protected $hotel;
    protected $dateChanges;
    protected $operation;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($date, $hotel, $dateChanges, $operation)
    {
        $this->date;
        $this->hotel = $hotel;
        $this->dateChanges = $dateChanges;
        $this->operation = $operation;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $dateChanges = $this->dateChanges;
        $date = $this->date;
        $hotel = $this->hotel;

        $calendarRepository = new CalendarRepository();
        $updatedCalendar = $calendarRepository->mountCalendar($hotel);

        if ($this->operation == "create" || $this->operation == "update") {
            $dateRequest = [
                'accommodations_id' => $date['accommodations_id'],
                'date' => $date['accommodations_id'],
                'stock_total' => $date['accommodations_id'],
                'min_stay' => $date['accommodations_id'],
                'close_arrival' => $date['accommodations_id'],
                'close_departure' => $date['accommodations_id'],
                'stop_sales' => $date['accommodations_id'],
                'prices' => $date['accommodations_id'],
                'currency' => $date['accommodations_id']
            ];
            Http::put('https://api.connect.zarpo.com/calendar', $dateRequest);
        } elseif ($this->operation == "delete") {
            $date_id = $date['id'];
            Http::delete(route('api.hotel.update', $date_id));
        }
    }
}
