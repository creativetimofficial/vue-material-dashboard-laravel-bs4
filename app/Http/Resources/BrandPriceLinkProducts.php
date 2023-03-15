<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandPriceLinkProducts extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "products_id" => $request->products_id,
            "brands_id" => $request->brands_id,
            "product_url" => $request->product_url,
            "price" => $request->price
        ];
    }
}
