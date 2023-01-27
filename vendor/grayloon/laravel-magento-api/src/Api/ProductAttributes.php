<?php

namespace Grayloon\Magento\Api;

class ProductAttributes extends AbstractApi
{
    /**
     * Retrieve specific product attribute information.
     *
     * @param  string  $attribute
     * @return array
     */
    public function show($attribute)
    {
        return $this->get('/products/attributes/'.$attribute);
    }
}
