<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SyncConnectAccommodations implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $accommodation;
    protected $hotel;
    protected $accommodationChanges;
    protected $operation;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($accommodation, $hotel, $accommodationChanges, $operation)
    {
        $this->accommodation = $accommodation;
        $this->hotel = $hotel;
        $this->accommodationChanges = $accommodationChanges;
        $this->operation = $operation;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $accommodationChanges = $this->accommodationChanges;
        $accommodation = $this->accommodation;
        $hotel = $this->hotel;

        if ($this->operation == "create") {
            $accommodationRequest = [
                'hotel_id' => $hotel['id'],
                'name' => $accommodation['name'],
                'rooms_id' => $accommodation['rooms_id'],
            ];

            Http::put('https://api.connect.zarpo.com/accommodations', $accommodationRequest);
        } elseif ($this->operation == "update") {
            unset($accommodationChanges['updated_at']); // retirando do array de mudanças de accommodation o updated_at
            $accommodationRequest = $accommodationChanges;
            Http::post('https://api.connect.zarpo.com/accommodations/'.$accommodation->id.'', $accommodationRequest);
        } elseif ($this->operation == "delete") {
            $accommodation_id = $accommodation['id'];
            Http::delete('https://api.connect.zarpo.com/accommodations/'.$accommodation->id.'');
        }
    }
}
