<?php

namespace JamesDordoy\LaravelVueDatatable\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DataTableCollectionResource extends ResourceCollection
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
            'data' => $this->collection,
            'payload' => $request->all()
        ];
    }
}
