<?php

use JamesDordoy\LaravelVueDatatable\Tests\TestCase;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class RelationshipFactoryTest extends TestCase
{ 
    public function test_is_working()
    {
        
    }

    protected function getPackageProviders($app)
    {
        return ['JamesDordoy\LaravelVueDatatable\Providers\LaravelVueDatatableServiceProvider'];
    }
}