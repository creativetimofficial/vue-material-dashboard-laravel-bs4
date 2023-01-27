<?php

namespace JamesDordoy\LaravelVueDatatable\Classes\Filters;

class FilterLocalData
{
    public function __invoke($query, $searchValue, $model, $localColumns)
    {
        $searchTerm = config('laravel-vue-datatables.models.search_term');

        if (isset($localColumns)) {
            return $query->where(function($query) use ($searchValue, $searchTerm, $model, $localColumns) {
                foreach ($localColumns as $key => $column) {
                    if (isset($column[$searchTerm])) {
                        if ($key === key($localColumns)) {
                            $query->where($model->getTable() . ".$key", 'like', "%$searchValue%");
                        } else {
                            $query->orWhere($model->getTable() . ".$key", 'like', "%$searchValue%");
                        }
                    }
                }
            });
        }
        
        return $query;
    }
}