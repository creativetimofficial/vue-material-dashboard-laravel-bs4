<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrandPriceLinkProducts extends Model
{
    protected $fillable = ['products_id', 'brands_id', 'product_url', 'price'];

    public function products()
    {
        return $this->belongsToMany('App\Products');
    }

    public function brands()
    {
        return $this->belongsToMany('App\Brands');
    }
}
