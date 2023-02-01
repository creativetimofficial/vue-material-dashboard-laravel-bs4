<?php

namespace JamesDordoy\LaravelVueDatatable\Classes\Relationships;

use JamesDordoy\LaravelVueDatatable\Exceptions\RelationshipModelNotSetException;
use JamesDordoy\LaravelVueDatatable\Exceptions\RelationshipColumnsNotFoundException;
use JamesDordoy\LaravelVueDatatable\Exceptions\RelationshipForeignKeyNotSetException;

class GetHasOneRelationships
{
    public function __invoke($declaredRelationship, $relationships, $with = [])
    {
        if (isset($declaredRelationship['hasOne'])) {

            $hasOne = array_keys($declaredRelationship['hasOne']);

            foreach ($hasOne as $key => $item) {
                if (in_array($item, $relationships)) {
                    $with[] = $item;
                }
            }

            return $with;
        }
        
        return $with;
    }
}