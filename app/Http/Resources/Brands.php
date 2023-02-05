<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Brands extends JsonResource
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
            'description' => $this->description,
            'url_image_path' => $this->url_image_path,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
