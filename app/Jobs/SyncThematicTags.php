<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Repository\Eloquent\ThematicTagsRepository;
use Grayloon\Magento\Magento;

class SyncThematicTags implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $ThematicTagsRepository = new ThematicTagsRepository();
        $hotels = $ThematicTagsRepository->syncThematicTagsMagento();
        $magento = new Magento();
        foreach ($hotels as $sku => $thematics) {
            $attr = [
                "product" => [
                    "custom_attributes" => [
                        [
                            "attribute_code" => "datas_especiais",
                            "value" => implode(',', $thematics)
                        ]
                    ]
                ]
            ];
            $magento->api('integration')->update($attr, $sku);
        }
    }
}
