<?php

namespace Grayloon\Magento\Api;

class CartTotals extends AbstractApi
{
    /**
     * Returns information for the cart total for the authenticated customer. Must have a store code.
     *
     * @return array
     */
    public function mine()
    {
        $this->validateSingleStoreCode();

        return $this->get('/carts/mine/totals');
    }
}
