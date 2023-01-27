<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Promotion extends JsonResource
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
            'status' => $this->status,
            'hotel_id' => $this->hotel_id,
            'discount_value' => $this->discount_value,
            'discount_type' => $this->discount_type,
            "promotion_type" => $this->promotion_type,
            "promotio_value" => $this->promotion_value,
            "promotion_start" => $this->promotion_start,
            "promotion_end" => $this->promotion_end,
            "week_days" => $this->week_days,
            "interval_start" => $this->interval_start,
            "interval_end" => $this->interval_end,
            "period_start" => $this->period_start,
            "period_end" => $this->period_end,
            "blackout_days" => $this->blackout_days,
            "accommodations_selected" => $this->accommodations_selected,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
