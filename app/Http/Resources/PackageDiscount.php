<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageDiscount extends JsonResource
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
            'hotel_id' => $this->hotel_id,
            'discount_net' => $this->discount_net,
            'discount_client' => $this->discount_client,
            'date_start' => $this->date_start,
            'date_end'=> $this->date_end,
            'discount_type' => $this->discount_type,
            'interval_start' => $this->interval_start,
            'interval_end' => $this->interval_end,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
