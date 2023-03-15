<?php

namespace JamesDordoy\LaravelVueDatatable\Classes\Filters;

use JamesDordoy\LaravelVueDatatable\Exceptions\RelationshipModelNotSetException;
use JamesDordoy\LaravelVueDatatable\Exceptions\RelationshipColumnsNotFoundException;

class FilterBelongsToManyRelationships
{
    public function __invoke($query, $searchValue, $relationshipModelFactory, $model, $relationships)
    {
        if (isset($relationships['belongsToMany'])) {

            $searchTerm = config('laravel-vue-datatables.models.search_term');

            foreach ($relationships['belongsToMany'] as $tableName => $options) {

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

                $query = $query->orWhereHas($tableName, function ($query) use ($searchValue, $model, $options, $searchTerm) {
                    //Get the real table name
                    $tableName = $model->getTable();

                    foreach ($options['columns'] as $columnName => $column) {
                        //Check if column is searchable
                        if ($column[$searchTerm]) {
                            //Check if first key
                            if ($columnName === key($options['columns'])) {
                                $query->where("$tableName.$columnName", "like",  "%$searchValue%");
                            } else {
                                $query->orWhere("$tableName.$columnName", "like",  "%$searchValue%");
                            }
                        }
                    }  
                });
            }
        }
    }
}