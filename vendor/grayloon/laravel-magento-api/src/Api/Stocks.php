<?php

namespace Grayloon\Magento\Api;

class Stocks extends AbstractApi
{
    /**
     * inventoryApiStocksRepositoryV1
     * All of paginated stock items.
     *
     * @param  int  $pageSize
     * @param  int  $currentPage
     * @param  array  $filters
     *
     * @return array
     */
    public function all($pageSize = 50, $currentPage = 1, $filters = [])
    {
        return $this->get('/inventory/stocks', array_merge($filters, [
            'searchCriteria[pageSize]'    => $pageSize,
            'searchCriteria[currentPage]' => $currentPage,
        ]));
    }
}
