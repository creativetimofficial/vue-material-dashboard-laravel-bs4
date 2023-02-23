<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Products extends Model
{
    use LaravelVueDatatableTrait;

    protected $fillable = ['name', 'description', 'categories_id', 'brands_id', 'price', 'image_url', 'product_url'];

    protected $dataTableColumns = [
        'id' => [
            'searchable' => true,
        ],
        'name' => [
            'searchable' => true,
        ],
        'description' => [
            'searchable' => true,
        ],
        'price' => [
            'searchable' => true,
        ],
        'created_at' => [
            'searchable' => true,
        ],
        'updated_at' => [
            'searchable' => true,
        ]
    ];

    public function categories()
    {
        return $this->belongsTo('App\Categories');
    }

    public function brands()
    {
        return $this->belongsTo('App\Brands');
    }

    public function comments()
    {
        return $this->hasMany('App\Comments');
    }
}
