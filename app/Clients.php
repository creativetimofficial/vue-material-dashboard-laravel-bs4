<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Clients extends Model
{
    use LaravelVueDatatableTrait;

    protected $fillable = ['name', 'email', 'email_verified_at', 'password'];

    protected $dataTableColumns = [
        'id' => [
            'searchable' => true,
        ],
        'name' => [
            'searchable' => true,
        ],
        'email' => [
            'searchable' => true,
        ],
        'created_at' => [
            'searchable' => true,
        ],
        'updated_at' => [
            'searchable' => true,
        ]
    ];
}
