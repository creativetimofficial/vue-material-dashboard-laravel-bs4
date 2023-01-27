<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SyncConnectHotels implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $hotel;
    protected $hotel_changes;
    protected $operation;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($hotel, $hotel_changes, $operation)
    {
        $this->hotel = $hotel;
        $this->hotel_changes = $hotel_changes;
        $this->operation = $operation;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $hotel = $this->hotel;
        $hotel_changes = $this->hotel_changes;

        if ($this->operation == "create") {
            $hotelRequest = [
                'name' => $hotel['name'],
                'markup' => $hotel['markup'],
                'net_discount' => $hotel['net_discount'],
                'client_discount' => $hotel['client_discount'],
                'extra_fess' => $hotel['extra_fess'],
                'checkin_protected' => $hotel['checkin_protected'],
                'status' => $hotel['status'],
                'city' => $hotel['city']
            ];
            Http::put('https://api.connect.zarpo.com/hotels', $hotelRequest);
        } elseif ($this->operation == "update") {
            unset($hotel_changes['updated_at']); // retirando do array de mudanças de hotel o updated_at
            $hotelRequest = $hotel_changes;
            Http::post('https://api.connect.zarpo.com/hotels/'.$hotel->id.'', $hotelRequest);
        } elseif ($this->operation == "delete") {
            $hotel_id = $hotel['id'];
            Http::delete('https://api.connect.zarpo.com/hotels/'.$hotel->id.'');
        }
    }
}
