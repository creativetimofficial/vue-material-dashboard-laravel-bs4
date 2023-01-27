<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationSource extends JsonResource
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
            'id_magento' => $this->id_magento,
            'name' => $this->name,
            'website_magento' => $this->website_magento,
            'sort_order' => $this->sort_order,
            'commission_percentage' => $this->commission_percentage,
            'status' => $this->status,
            'markup' => $this->markup,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
