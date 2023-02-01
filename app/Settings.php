<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Settings extends Model
{
    use SoftCascadeTrait;
    use LaravelVueDatatableTrait;
    protected $fillable = ['label', 'value'];

    protected $dataTableColumns = [
        'id' => [
            'searchable' => true,
        ],
        'label' => [
            'searchable' => true,
        ],
        'value' => [
            'searchable' => true,
        ],
    ];
}
