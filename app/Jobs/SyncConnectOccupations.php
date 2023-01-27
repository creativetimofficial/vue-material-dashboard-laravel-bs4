<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SyncConnectOccupations implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $occupation;
    protected $hotel;
    protected $occupationChanges;
    protected $operation;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($occupation, $hotel, $occupationChanges, $operation)
    {
        $this->occupation = $occupation;
        $this->hotel = $hotel;
        $this->occupationChanges = $occupationChanges;
        $this->operation = $operation;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $occupationChanges = $this->occupationChanges;
        $occupation = $this->occupation;
        $hotel = $this->hotel;

        if ($this->operation == "create") {
            $occupationRequest = [
                'hotel_id' => $hotel['id'],
                'name' => $occupation['name'],
                'adults' => $occupation['adults'],
                'children' => $occupation['children'],
                'children_free' => $occupation['children_free'],
                'children_max_age' => $occupation['children_max_age'],
                'accommodations_id' => $occupation['accommodations_id']
            ];
            Http::put('https://api.connect.zarpo.com/occupations', $occupationRequest);
        } elseif ($this->operation == "update") {
            unset($occupationChanges['updated_at']); // retirando do array de mudanças de accommodation o updated_at
            $occupationRequest = $occupationChanges;
            Http::post('https://api.connect.zarpo.com/occupations/'.$occupation->id.'', $occupationRequest);
        } elseif ($this->operation == "delete") {
            $occupation_id = $occupation['id'];
            Http::delete('https://api.connect.zarpo.com/occupations/'.$occupation->id.'');
        }
    }
}
