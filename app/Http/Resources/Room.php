<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Accommodation as AccommodationResource;

class Room extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'hotel_id' => $this->hotel_id,
            'name' => $this->name,
            'min_adults' => $this->min_adults,
            'max_adults' => $this->max_adults,
            'min_children' => $this->min_children,
            'max_children' => $this->max_children,
            'max_occupancy' => $this->max_occupancy,
            'accommodations' => AccommodationResource::collection($this->accommodations),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
