<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PartnerMarkup as PartnerMarkupResource;

class Hotel extends JsonResource
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
            'city' => $this->city,
            'markup' => $this->markup,
            'net_discount' => $this->net_discount,
            'client_discount' => $this->client_discount,
            'checkin_protected' => $this->checkin_protected,
            'reference_price' => $this->reference_price,
            'status' => $this->status,
            'when_to_pay' => $this->when_to_pay,
            'passthru' => $this->passthru,
            'calendar_status' => $this->calendar_status,
            'extra_fees' => $this->extra_fees,
            'last_updated_rate' => $this->last_updated_rate,
            'partners' => $this->partners,
            'connection_type' => $this->connection_type,
            'magento_id' => $this->magento_id,
            'omnibees_id' => $this->omnibees_id,
            'partner_markups' =>  PartnerMarkupResource::collection($this->partnerMarkup),
            'currency' => $this->currency,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'rules' => $this->rules,
            'deleted_at' => $this->deleted_at
        ];
    }
}
