<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Comments extends Model
{
    use LaravelVueDatatableTrait;

    protected $fillable = ['clients_id', 'products_id', 'title', 'description', 'status', 'rate'];

    protected $dataTableColumns = [
        'id' => [
            'searchable' => true,
        ],
        'clients_id' => [
            'searchable' => true,
        ],
        'title' => [
            'searchable' => true,
        ],
        'products_id' => [
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
        return $this->belongsTo('App\Products');
    }

    public function clients()
    {
        return $this->belongsTo('App\Clients');
    }

}