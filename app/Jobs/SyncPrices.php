<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Repository\Eloquent\MagentoRepository;
use Grayloon\Magento\Magento;

class SyncPrices implements ShouldQueue
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
        $accommodations = $magentoRepository->syncPrices();
        $magento = new Magento();
        foreach ($accommodations as $sku => $prices) {
            $attr = [
                "product" => [
                    "price" => $prices['price'],
                    "custom_attributes" => [
                        [
                            "attribute_code" => "special_price",
                            "value" => $prices['special_price']
                        ],
                        [
                            "attribute_code" => "cost",
                            "value" => $prices['cost']
                        ]
                    ]
                ]
            ];
            $magento->api('integration')->update($attr, $sku);
        }
    }
}
