<?php

namespace App\Jobs;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Repository\Eloquent\CalendarRepository;
use App\Accommodations;
use App\Hotel;
use App\Dates;
use App\Repository\Eloquent\AccommodationRepository;
use App\Repository\Eloquent\HotelRepository;
use App\Http\Requests\DatesRequest;

class SendCsvAccommodations implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $hotelRepository = new HotelRepository;
        $hotelRepository->sendCsvAccommodations($this->data);
    }
}