<?php

namespace App;

use App\Products;
use App\BrandPriceLinkProducts;
use Illuminate\Database\Eloquent\Model;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Brands extends Model
{
    use LaravelVueDatatableTrait;

    protected $fillable = ['name', 'description', 'url_image_path'];

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
        'created_at' => [
            'searchable' => true,
        ],
        'updated_at' => [
            'searchable' => true,
        ]
    ];

    public function brandPriceLinkProducts()
    {
        return $this->hasMany(BrandPriceLinkProducts::class);
    }
}
