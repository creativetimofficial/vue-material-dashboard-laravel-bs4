<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Repository\Eloquent\MagentoRepository;
use Grayloon\Magento\Magento;

class SyncLastCheckIn implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $magentoRepository = new MagentoRepository();
        $hotels = $magentoRepository->syncLastCheckIn();
        $magento = new Magento();
        foreach ($hotels as $hotel => $date) {
            $attr = [
                "product" => [
                    "custom_attributes" => [
                        [
                            "attribute_code" => "last_check_in",
                            "value" => $date
                        ]
                    ]
                ]
            ];
            $magento->api('integration')->update($attr, $hotel);
        }
    }
}
