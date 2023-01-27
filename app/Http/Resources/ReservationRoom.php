<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Resources\ReservationRoomAccommodation;
use App\ReservationRooms;
use App\Repository\Eloquent\ReservationRoomRepository;

class ReservationRoom extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $reservationRoomRepository = new ReservationRoomRepository();
        $accommodation = $reservationRoomRepository->getReservationRoomAccommodation($this->accommodation_id);
        return [
            'id' => $this->id,
            'reservation_id' => $this->reservation_id,
            'hotel_id' => $this->hotel_id,
            'accommodation' => $accommodation,
            'status' => $this->status,
            'check_in' => $this->check_in,
            'check_out' => $this->check_out,
            'adults' => $this->adults,
            'children' => $this->children,
            'nights' => $this->nights,
            'cost_price' => $this->cost_price,
            'package' => $this->package,
            'children_age' => $this->children_age,
            'price' => $this->price,
            'responsible' => $this->responsible,
            'occupation_id' => $this->occupation_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
