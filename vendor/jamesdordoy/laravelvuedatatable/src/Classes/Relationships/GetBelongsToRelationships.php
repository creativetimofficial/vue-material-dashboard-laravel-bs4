<?php

namespace JamesDordoy\LaravelVueDatatable\Classes\Relationships;

use JamesDordoy\LaravelVueDatatable\Exceptions\RelationshipModelNotSetException;
use JamesDordoy\LaravelVueDatatable\Exceptions\RelationshipColumnsNotFoundException;
use JamesDordoy\LaravelVueDatatable\Exceptions\RelationshipForeignKeyNotSetException;

class GetBelongsToRelationships
{
    public function __invoke($declaredRelationship, $relationships, $with = [])
    {
        if (isset($declaredRelationship['belongsTo'])) {

            $belongsTo = array_keys($declaredRelationship['belongsTo']);

            foreach ($belongsTo as $key => $item) {
                if (in_array($item, $relationships)) {
                    $with[] = $item;
                }
            }

            return $with;
        }
        
        return $with;
    }
}