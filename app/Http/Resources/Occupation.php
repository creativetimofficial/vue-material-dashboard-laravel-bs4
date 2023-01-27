<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Occupation extends JsonResource
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
            'id_magento_one' => $this->id_magento_one,
            'name' => $this->name,
            'hotel_id' => $this->hotel_id,
            'accommodations_id' => $this->accommodations_id,
            "adults" => $this->adults,
            "children" => $this->children,
            "children_free" => $this->children_free,
            "zio_sub_room_id" => $this->zio_sub_room_id,
            "children_max_age" => $this->children_max_age,
            "status" => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
