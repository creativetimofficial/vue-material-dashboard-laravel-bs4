<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Repository\Eloquent\RoomRepository;

class ReservationRoomAccommodation extends JsonResource
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
            'name' => $this->name,
            'rate' => $this->rates,
            'room' => $this->rooms,
            'max_adults' => $room->max_adults,
            'max_children' => $room->max_children,
        ];
    }
}
