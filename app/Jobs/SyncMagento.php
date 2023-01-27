<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Repository\Eloquent\MagentoRepository;
use App\Hotel;

class SyncMagento implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    /**
    *
    * @var Hotel
    *
    */
    protected $hotel;

    /**
     * Create a new job instance.
     *
     * @param Hotel $hotel
     *
     * @return void
     */
    public function __construct(Hotel $hotel)
    {
        $this->hotel = $hotel;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $MagentoRepository = new MagentoRepository();
        $MagentoRepository->sync($this->hotel);
    }
}
