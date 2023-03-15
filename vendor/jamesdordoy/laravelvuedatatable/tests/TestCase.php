<?php

namespace JamesDordoy\LaravelVueDatatable\Tests;

use Orchestra\Testbench\TestCase as PackageTestCase;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class TestCase extends PackageTestCase
{ 
    protected function getPackageProviders($app)
    {
        return ['JamesDordoy\LaravelVueDatatable\Providers\LaravelVueDatatableServiceProvider'];
    }
}