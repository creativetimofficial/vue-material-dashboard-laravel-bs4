<?php

namespace JamesDordoy\LaravelVueDatatable\Contracts;

interface ExceptionHandlerContract {
    function checkForModel($model, $tableName);
    function checkForForeignKey($key, $tableName);
}