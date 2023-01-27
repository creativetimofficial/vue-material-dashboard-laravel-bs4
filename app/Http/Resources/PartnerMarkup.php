<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PartnerMarkup extends JsonResource
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
            'partner' => $this->partner,
            'markup_partner' => $this->markup_partner,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
