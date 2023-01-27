<?php

namespace Grayloon\Magento\Api;

class Schema extends AbstractApi
{
    /**
     * The Magento 2 API Schema.
     *
     * @return array
     */
    public function show()
    {
        $this->magento->versionIncluded = false;

        return $this->get('/schema');
    }
}
