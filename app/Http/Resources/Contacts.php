<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Contacts extends JsonResource
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
            'contact_client' => $this->contact_client,
            "contact_info_1" => $this->contact_info_1,
            "contact_info_2" => $this->contact_info_2,
            "contact_info_3" => $this->contact_info_3,
            "contact_zarpo" => $this->contact_zarpo,
            "contact_voucher" => $this->contact_voucher,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
