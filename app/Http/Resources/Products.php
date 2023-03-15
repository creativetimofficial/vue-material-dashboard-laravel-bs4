<?php

namespace App\Http\Resources;

use App\BrandPriceLinkProducts as AppBrandPriceLinkProducts;
use App\Http\Resources\BrandPriceLinkProducts;
use Illuminate\Http\Resources\Json\JsonResource;

class Products extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'categories' => $this->categories_id,
            'description' => $this->description,
            'image_url' => $this->image_url,
            'brand_price_link_products' => AppBrandPriceLinkProducts::where('products_id', '=', $this->id)->get(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
