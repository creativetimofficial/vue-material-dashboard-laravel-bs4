<?php

namespace JamesDordoy\LaravelVueDatatable\Classes\Filters;

use JamesDordoy\LaravelVueDatatable\Exceptions\RelationshipModelNotSetException;
use JamesDordoy\LaravelVueDatatable\Exceptions\RelationshipColumnsNotFoundException;

class FilterHasOneRelationships
{
    public function __invoke($query, $searchValue, $relationshipModelFactory, $model, $relationships)
    {
        $searchTerm = config('laravel-vue-datatables.models.search_term');

        if (isset($relationships['hasOne'])) {

            foreach ($relationships['hasOne'] as $tableName => $options) {  

                if (! isset($options['model'])) {     
                    throw new RelationshipModelNotSetException(
                        "Model not set on relationship: $tableName"
                    );
                }

                if (! isset($options['columns'])) {
                    throw new RelationshipColumnsNotFoundException(
                        "Columns array not set on relationship: $tableName"
                    );
                }

                $model = $relationshipModelFactory($options['model'], $tableName);

                return $query->orWhereHas($tableName, function ($query) use ($searchValue, $model, $options, $searchTerm) {
                    
                    if (isset($options['columns'])) {
                        
                        $tableName = $model->getTable();

                        foreach ($options['columns'] as $columnName => $col) {
                            if ($col[$searchTerm]) {
                                if ($columnName === key($options['columns'])) {
                                    $query->where("$tableName.$columnName", "like",  "%$searchValue%");
                                } else {
                                    $query->orWhere("$tableName.$columnName", "like",  "%$searchValue%");
                                }
                            }
                        }
                    } 
                });
            }
        }

        return $query;
    }
}