<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\ZioMigration;

class SyncAllOfZio implements ShouldQueue
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
        $zioMigrationRepository = new ZioMigration();
        $zioMigrationRepository->syncOccupationWithoutTruncate();
        $zioMigrationRepository->syncRatesWithoutTruncate();
        $zioMigrationRepository->syncAccommodationsWithoutTruncate();
        $zioMigrationRepository->syncRoomsWithoutTruncate();
        $zioMigrationRepository->syncTaxesWithoutTruncate();
        $zioMigrationRepository->syncPromotionsWithoutTruncate();
    }
}
