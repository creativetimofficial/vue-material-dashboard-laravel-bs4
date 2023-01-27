<?php

namespace Grayloon\Magento\Api;

class SourceItems extends AbstractApi
{
    /**
     * inventoryApiSourceItemRepositoryV1
     * All of paginated source items.
     *
     * @param  int  $pageSize
     * @param  int  $currentPage
     * @param  array  $filters
     *
     * @return array
     */
    public function all($pageSize = 50, $currentPage = 1, $filters = [])
    {
        return $this->get('/inventory/source-items', array_merge($filters, [
            'searchCriteria[pageSize]'    => $pageSize,
            'searchCriteria[currentPage]' => $currentPage,
        ]));
    }
}
