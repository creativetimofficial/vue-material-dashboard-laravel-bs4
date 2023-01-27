<?php

namespace JamesDordoy\LaravelVueDatatable\Classes\Relationships;

use JamesDordoy\LaravelVueDatatable\Exceptions\RelationshipModelNotSetException;
use JamesDordoy\LaravelVueDatatable\Exceptions\RelationshipColumnsNotFoundException;
use JamesDordoy\LaravelVueDatatable\Exceptions\RelationshipForeignKeyNotSetException;

class GetBelongsToManyRelationships
{
    public function __invoke($declaredRelationship, $relationships, $with = [], $orderByDir)
    {
        if (isset($declaredRelationship['belongsToMany'])) {

            $belongsToMany = array_keys($declaredRelationship['belongsToMany']);

            foreach ($belongsToMany as $key => $item) {
                if (! is_numeric($key) && in_array($key, $relationships)){
                    $with[$key] = $item;
                }       
            }

            foreach ($declaredRelationship['belongsToMany'] as $tableName => $relationship) {
    
                foreach ($belongsToMany as $name) {
                    if ($tableName === $name) {

                        if (isset($relationship['order_by'])) {
                            $orderBy = $relationship['order_by'];

                            $with[$name] = function($q) use ($orderBy, $orderByDir) {
                                $q->orderBy($orderBy, $orderByDir);
                            };
                        }
                    }
                }
            }

            return $with;
        }
        
        return $with;
    }
}