<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SyncConnectRooms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $hotel;
    protected $room;
    protected $operation;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->hotel = $hotel;
        $this->room = $room;
        $this->operation = $operation;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $room = $this->room;
        $hotel = $this->hotel;

        if ($this->operation == "create") {
            $roomRequest = [
                'hotel_id' => $hotel['id'],
                'name' => $room['name'],
                'min_adults' => $room['min_adults'],
                'max_adults' => $room['max_adults'],
                'min_children' => $room['min_children'],
                'max_children' => $room['max_children'],
                'max_occupancy' => $room['max_occupancy']
            ];
            Http::post('https://api.connect.zarpo.com/rooms', $roomRequest);
        } elseif ($this->operation == "update") {
            unset($room['updated_at']); // retirando do array de mudanças de accommodation o updated_at
            $roomRequest = $room;
            Http::post('https://api.connect.zarpo.com/rooms/'.$room->id.'', $roomRequest);
        } elseif ($this->operation == "delete") {
            $room_id = $room['id'];
            Http::delete('https://api.connect.zarpo.com/rooms/'.$room->id.'');
        }
    }
}
