<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DatesCalendar as DatesCalendarResource;

class Calendar extends JsonResource
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
            'hotel_id' => $this->id,
            'min_price' => $this->min_price,
            'dates' =>  DatesCalendarResource::collection($this->dates),
        ];
    }
}
