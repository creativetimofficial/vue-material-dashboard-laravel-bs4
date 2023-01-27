<?php

namespace JamesDordoy\LaravelVueDatatable\Exceptions;

use JamesDordoy\LaravelVueDatatable\Contracts\ExceptionHandlerContract;
use JamesDordoy\LaravelVueDatatable\Exceptions\RelationshipForeignKeyNotSetException;

class ExceptionHandler implements ExceptionHandlerContract
{
    public function checkForModel($model, $tableName)
    {

    }

    public function checkForForeignKey($key, $tableName)
    {
        if (! isset($key)) {
            throw new RelationshipForeignKeyNotSetException(
                "Foreign Key not set on relationship: $tableName"
            );
        }

        return true;
    }
}