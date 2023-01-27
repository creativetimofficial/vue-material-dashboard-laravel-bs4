<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Occupation as OccupationResource;
use App\Rooms;
use App\Repository\Eloquent\RoomRepository;

class Accommodation extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $roomRepository = new RoomRepository();
        $room = $roomRepository->show($this->rooms_id);
        return [
            'id' => $this->id,
            'hotel_id' => $this->hotel_id,
            'name' => $this->name,
            'status' => $this->status,
            'rates_id' => $this->rates_id,
            'rooms_id' => $this->rooms_id,
            'magento_id' => $this->magento_id,
            'min_adults' => $room->min_adults,
            'max_adults' => $room->max_adults,
            'min_children' => $room->min_children,
            'max_children' => $room->max_children,
            'max_occupancy' => $room->max_occupancy,
            'occupations' =>  OccupationResource::collection($this->occupations),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'magento_deleted_at' => $this->magento_deleted_at
        ];
    }
}
