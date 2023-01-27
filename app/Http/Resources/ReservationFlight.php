<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationFlight extends JsonResource
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
            'reservation_id' => $this->reservation_id,
            'status' => $this->status,
            'flight_numbers' => $this->flight_numbers,
            'stops' => $this->stops,
            'tariff_type' => $this->tariff_type,
            'included_baggage' => $this->included_baggage,
            'tax_total' => $this->tax_total,
            'tariff_total' => $this->tariff_total,
            'departure_time' => $this->departure_time,
            'arrive_time' => $this->arrive_time,
            'iata_from' => $this->iata_from,
            'iata_to' => $this->iata_to,
            'passengers' => $this->passengers,
            'pnr_locator' => $this->pnr_locator,
            'service_order' => $this->service_order,
            'supplier_system' => $this->supplier_system,
            'total_price' => $this->total_price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
