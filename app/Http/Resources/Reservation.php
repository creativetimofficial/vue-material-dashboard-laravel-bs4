<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ReservationRoom as ReservationRoomResource;
use App\Http\Resources\ReservationFlight as ReservationFlightResource;

class Reservation extends JsonResource
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
            'magento_id' => $this->magento_id,
            'reservation_source_id' => $this->reservation_source_id,
            'hotel_id' => $this->hotel_id,
            'client_id' => $this->client_id,
            'client_email' => $this->client_email,
            'client_name' => $this->client_name,
            'cpf' => $this->cpf,
            'client_phone' => $this->client_phone,
            'payment_method' => $this->payment_method,
            'payment_information' => $this->payment_information,
            'points_used' => $this->points_used,
            'credits_used' => $this->credits_used,
            'subtotal' => $this->subtotal,
            'total' => $this->total,
            'special_request' => $this->special_request,
            'status' => $this->status,
            'order_date' => $this->order_date,
            'payment_fee' => $this->payment_fee,
            'reservation_room' =>  ReservationRoomResource::collection($this->reservationRooms),
            'reservation_flight' =>  ReservationFlightResource::collection($this->reservationFlights),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
