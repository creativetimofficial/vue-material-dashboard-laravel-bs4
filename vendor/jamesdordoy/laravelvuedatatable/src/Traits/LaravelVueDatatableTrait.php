<?php

namespace JamesDordoy\LaravelVueDatatable\Traits;

use JamesDordoy\LaravelVueDatatable\Classes\QueryBuilder;

trait LaravelVueDatatableTrait
{
    public function scopeEloquentQuery($query, $orderBy = 'id', $orderByDir = 'asc', $searchValue = '', $relationships = [])
    {
        $queryBuilder = new QueryBuilder($this, $query, $this->dataTableColumns, $this->dataTableRelationships);
        
        return $queryBuilder->selectData()
            ->addRelationships($relationships, $orderByDir)
            ->orderBy($orderBy, $orderByDir)
            ->filter($searchValue)
            ->getQuery();
    }
}
