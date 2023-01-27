<?php

namespace Grayloon\Magento\Api;

class Carts extends AbstractApi
{
    /**
     * Returns information for the cart for the authenticated customer. Must have a store code.
     *
     * @return array
     */
    public function mine()
    {
        $this->validateSingleStoreCode();

        return $this->get('/carts/mine');
    }

    /**
     * Returns information for the cart for the authenticated customer. Must have a store code.
     *
     * @return array
     */
    public function create()
    {
        $this->validateSingleStoreCode();

        return $this->post('/carts/mine');
    }

    /**
     * Estimate shipping by address and return list of available shipping methods.
     *
     * @param  array  $body
     * @return array
     */
    public function estimateShippingMethods($body = [])
    {
        $this->validateSingleStoreCode();

        return $this->post('/carts/mine/estimate-shipping-methods', $body);
    }

    /**
     * Calculate quote totals based on address and shipping method.
     *
     * @param  array  $body
     * @return array
     */
    public function totalsInformation($body = [])
    {
        $this->validateSingleStoreCode();

        return $this->post('/carts/mine/totals-information', $body);
    }

    /**
     * Save the total shipping information.
     *
     * @param  array  $body
     * @return array
     */
    public function shippingInformation($body = [])
    {
        $this->validateSingleStoreCode();

        return $this->post('/carts/mine/shipping-information', $body);
    }

    /**
     * Lists available payment methods for a specified shopping cart. This call returns an array of objects, but detailed information about each object’s attributes might not be included.
     *
     * @return array
     */
    public function paymentMethods()
    {
        $this->validateSingleStoreCode();

        return $this->get('/carts/mine/payment-methods');
    }

    /**
     * Set payment information and place order for a specified cart.
     *
     * @param  array  $body
     * @return array
     */
    public function paymentInformation($body = [])
    {
        $this->validateSingleStoreCode();

        return $this->post('/carts/mine/payment-information', $body);
    }

    /**
     * Apply a coupon to a specified cart.
     *
     * @param  string  $couponCode
     * @return void
     */
    public function couponCode($couponCode)
    {
        return $this->put('/carts/mine/coupons/'.$couponCode);
    }

    /**
     * Removes coupon(s) from specified cart.
     *
     * @return void
     */
    public function removeCoupons()
    {
        return $this->delete('/carts/mine/coupons');
    }
}
