<?php

namespace JamesDordoy\LaravelVueDatatable\Classes\Joins;

use JamesDordoy\LaravelVueDatatable\Exceptions\RelationshipModelNotSetException;
use JamesDordoy\LaravelVueDatatable\Exceptions\RelationshipPivotDataNotFoundException;
use JamesDordoy\LaravelVueDatatable\Exceptions\RelationshipColumnsNotFoundException;
use JamesDordoy\LaravelVueDatatable\Exceptions\RelationshipForeignKeyNotSetException;

class JoinBelongsToManyRelationships
{
    public function __invoke($query, $localModel, $relationships, $relationshipModelFactory)
    {
        if (isset($relationships['belongsToMany'])) {
            foreach ($relationships['belongsToMany'] as $tableName => $options) {

                if (! isset($options['model'])) {     
                    throw new RelationshipModelNotSetException(
                        "Model not set on relationship: $tableName"
                    );
                }

                if (! isset($options['pivot'])) {     
                    throw new RelationshipPivotDataNotFoundException(
                        "Pivot data not set on relationship: $tableName"
                    );
                }

                if (! isset($options['pivot']['table_name'])) {     
                    throw new RelationshipPivotDataNotFoundException(
                        "Pivot table_name not set on relationship: $tableName"
                    );
                }

                if (! isset($options['pivot']['local_key'])) {     
                    throw new RelationshipPivotDataNotFoundException(
                        "Pivot local_key not set on relationship: $tableName"
                    );
                }

                if (! isset($options['pivot']['foreign_key'])) {     
                    throw new RelationshipPivotDataNotFoundException(
                        "Pivot foreign_key not set on relationship: $tableName"
                    );
                }


                $model = $relationshipModelFactory($options['model'], $tableName);

                $tableName = $model->getTable();

                //Join the table so it can be orderBy
                $query = $query->leftJoin(
                    $options['pivot']['table_name'],
                    $localModel->getTable() . "." . $localModel->getKeyName(),
                    '=',
                    $options['pivot']['table_name'] . "." . $options['pivot']['local_key']
                );

                $query = $query->leftJoin(
                    $tableName,
                    $options['pivot']['table_name'] . "." . $options['pivot']['foreign_key'],
                    '=',
                    $tableName . "." . $localModel->getKeyName()
                );
            }
        }

        return $query;
    }
}