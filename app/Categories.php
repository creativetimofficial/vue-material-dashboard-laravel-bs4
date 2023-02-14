<?php

namespace App;

use App\Products;
use Illuminate\Database\Eloquent\Model;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Categories extends Model
{
    use LaravelVueDatatableTrait;

    protected $fillable = ['name', 'url_image_path'];

    protected $dataTableColumns = [
        'id' => [
            'searchable' => true,
        ],
        'name' => [
            'searchable' => true,
        ],
        'created_at' => [
            'searchable' => true,
        ],
        'updated_at' => [
            'searchable' => true,
        ]
    ];

    public function products()
    {
        return $this->hasMany(Products::class);
    }
}
