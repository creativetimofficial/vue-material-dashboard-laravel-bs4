<?php

namespace Grayloon\Magento\Api;

class CartItems extends AbstractApi
{
    /**
     * Lists items that are assigned to a specified customer cart. Must have a store code.
     *
     * @return array
     */
    public function mine()
    {
        $this->validateSingleStoreCode();

        return $this->get('/carts/mine/items');
    }

    /**
     * Add/update the specified cart item.
     *
     * @param  string  $quoteId
     * @param  string  $sku
     * @param  string  $quantity
     * @return array
     */
    public function addItem($quoteId, $sku, $quantity)
    {
        $this->validateSingleStoreCode();

        return $this->post('/carts/mine/items', [
            'cartItem' => [
                'qty'      => $quantity,
                'quoteId'  => $quoteId,
                'sku'      => $sku,
            ],
        ]);
    }

    /**
     * Update the specified cart item.
     *
     * @param  int    $itemId
     * @param  array  $body
     * @return array
     */
    public function editItem($itemId, $body = [])
    {
        $this->validateSingleStoreCode();

        return $this->put('/carts/mine/items/'.$itemId, $body);
    }

    /**
     * Remove the specified cart item.
     *
     * @param  int  $itemId
     * @return array
     */
    public function removeItem($itemId)
    {
        $this->validateSingleStoreCode();

        return $this->delete('/carts/mine/items/'.$itemId);
    }
}
