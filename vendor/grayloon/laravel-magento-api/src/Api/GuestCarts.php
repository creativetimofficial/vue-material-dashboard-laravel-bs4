<?php

namespace Grayloon\Magento\Api;

class GuestCarts extends AbstractApi
{
    /**
     * Enable an customer or guest user to create an empty cart and quote for an anonymous customer.
     *
     * @return string
     */
    public function create()
    {
        return $this->post('/guest-carts');
    }

    /**
     * Enable a guest user to return information for a specified cart.
     *
     * @return array
     */
    public function cart($cartId)
    {
        return $this->get('/guest-carts/'.$cartId);
    }

    /**
     * List items that are assigned to a specified cart.
     *
     * @return array
     */
    public function items($cartId)
    {
        return $this->get('/guest-carts/'.$cartId.'/items');
    }

    /**
     * Add/update the specified cart item.
     *
     * @param  string  $cartId
     * @param  string  $sku
     * @param  string  $quantity
     * @return array
     */
    public function addItem($cartId, $sku, $quantity)
    {
        return $this->post('/guest-carts/'.$cartId.'/items', [
            'cartItem' => [
                'quote_id' => $cartId,
                'sku'      => $sku,
                'qty'      => $quantity,
            ],
        ]);
    }

    /**
     * Add/update the specified cart item.
     *
     * @param  string  $cartId
     * @param  int     $itemId
     * @param  array   $body
     * @return array
     */
    public function editItem($cartId, $itemId, $body = [])
    {
        return $this->put('/guest-carts/'.$cartId.'/items/'.$itemId, $body);
    }

    /**
     * Return quote totals data for a specified cart.
     *
     * @return array
     */
    public function totals($cartId)
    {
        return $this->get('/guest-carts/'.$cartId.'/totals');
    }

    /**
     * Estimate shipping by address and return list of available shipping methods.
     *
     * @param  string $cartId
     * @param  array  $body
     * @return array
     */
    public function estimateShippingMethods($cartId, $body = [])
    {
        return $this->post('/guest-carts/'.$cartId.'/estimate-shipping-methods', $body);
    }

    /**
     * Calculate quote totals based on address and shipping method.
     *
     * @param  string $cartId
     * @param  array  $body
     * @return array
     */
    public function totalsInformation($cartId, $body = [])
    {
        return $this->post('/guest-carts/'.$cartId.'/totals-information', $body);
    }

    /**
     * Save the total shipping information.
     *
     * @param  string $cartId
     * @param  array  $body
     * @return array
     */
    public function shippingInformation($cartId, $body = [])
    {
        return $this->post('/guest-carts/'.$cartId.'/shipping-information', $body);
    }

    /**
     * List available payment methods for a specified shopping cart. This call returns an array of objects, but detailed information about each object’s attributes might not be included.
     *
     * @param  string $cartId
     * @return array
     */
    public function paymentMethods($cartId)
    {
        return $this->get('/guest-carts/'.$cartId.'/payment-methods');
    }

    /**
     * Set payment information and place order for a specified cart.
     *
     * @param  string $cartId
     * @param  array  $body
     * @return array
     */
    public function paymentInformation($cartId, $body = [])
    {
        return $this->post('/guest-carts/'.$cartId.'/payment-information', $body);
    }

    /**
     * Remove the specified item from the specified cart.
     *
     * @param  string  $cartId
     * @param  int  $itemId
     * @return array
     */
    public function removeItem($cartId, $itemId)
    {
        return $this->delete('/guest-carts/'.$cartId.'/items/'.$itemId);
    }

    /**
     * Apply a coupon to a specified cart.
     *
     * @param  string  $cartId
     * @param  string  $couponCode
     * @return void
     */
    public function couponCode($cartId, $couponCode)
    {
        return $this->put('/guest-carts/'.$cartId.'/coupons/'.$couponCode);
    }

    /**
     * Removes coupon(s) from specified cart.
     *
     * @return void
     */
    public function removeCoupons($cartId)
    {
        return $this->delete('/guest-carts/'.$cartId.'/coupons');
    }
}
