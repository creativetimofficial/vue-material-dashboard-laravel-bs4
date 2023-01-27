<?php

namespace Grayloon\Magento\Api;

class ProductLinkType extends AbstractApi
{
    /**
     * Retrieve information about available product link types.
     *
     * @return array
     */
    public function types()
    {
        return $this->get('/products/links/types');
    }
}
