<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Date extends JsonResource
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
            'accommodations_id' => $this->accommodations_id,
            'occupations_id' => $this->occupations_id,
            'date' => $this->date,
            'stock_total' => $this->stock_total,
            'stock_locked' => $this->stock_locked,
            'min_stay' => $this->min_stay,
            'close_arrival' => $this->close_arrival,
            'close_departure' => $this->close_departure,
            'stop_sales' => $this->stop_sales,
            'prices' => $this->prices,
            'currency' => $this->currency,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
