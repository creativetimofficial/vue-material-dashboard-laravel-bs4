<?php

namespace JamesDordoy\LaravelVueDatatable\Classes\Factories;

use JamesDordoy\LaravelVueDatatable\Exceptions\RelationshipModelNotInstantiatableException;

class RelationshipModelFactory
{
    public function __invoke($path, $tableName)
    {
        try {
            return new $path;
        } catch (\Throwable $e) {
            throw new RelationshipModelNotInstantiatableException(
                "Could not create model for $tableName: ".$path
            );
        }
    }
}