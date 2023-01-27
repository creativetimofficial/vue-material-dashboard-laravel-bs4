<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyHistoricModification extends JsonResource
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
            'id_currency' => $this->id_currency,
            'responsible' => $this->responsible,
            'attributes' => $this->attributes,
            'time' => $this->time,
            'change_in' => $this->change_in,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
