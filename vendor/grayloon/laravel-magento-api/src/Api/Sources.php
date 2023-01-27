<?php

namespace Grayloon\Magento\Api;

class Sources extends AbstractApi
{
    /**
     * inventoryApiSourcesRepositoryV1
     * All of paginated sources.
     *
     * @param  int  $pageSize
     * @param  int  $currentPage
     * @param  array  $filters
     *
     * @return array
     */
    public function all($pageSize = 50, $currentPage = 1, $filters = [])
    {
        return $this->get('/inventory/sources', array_merge($filters, [
            'searchCriteria[pageSize]'    => $pageSize,
            'searchCriteria[currentPage]' => $currentPage,
        ]));
    }

    /**
     * inventoryApiSourcesRepositoryV1
     * Return Specific Source by name.
     *
     * @param  string  $name
     *
     * @return array
     */
    public function bySourceName($name = 'default')
    {
        return $this->get('/inventory/sources/'.$name);
    }
}
