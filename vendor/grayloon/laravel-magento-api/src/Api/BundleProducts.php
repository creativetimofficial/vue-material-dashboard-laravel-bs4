<?php

namespace Grayloon\Magento\Api;

class BundleProducts extends AbstractApi
{
    /**
     * Get all options for bundle product.
     *
     * @param  string  $sku
     * @return array
     */
    public function options($sku)
    {
        return $this->get('/bundle-products/'.$sku.'/options/all');
    }
}
