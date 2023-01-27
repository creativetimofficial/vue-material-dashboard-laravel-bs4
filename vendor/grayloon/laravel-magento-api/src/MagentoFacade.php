<?php

namespace Grayloon\Magento;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Grayloon\Magento\Skeleton\SkeletonClass
 */
class MagentoFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'magento';
    }
}
