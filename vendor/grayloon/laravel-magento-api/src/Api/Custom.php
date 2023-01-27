<?php

namespace Grayloon\Magento\Api;

use Grayloon\Magento\Magento;

class Custom extends AbstractApi
{
    const HTTP_METHODS = ['get', 'post', 'put', 'delete'];

    /**
     * @var string Magento API endpoint
     */
    protected $endpoint;

    /**
     * Custom constructor.
     *
     * @param string $endpoint
     */
    public function __construct(string $endpoint, Magento $magento)
    {
        $this->endpoint = '/'.rtrim(ltrim($endpoint, '/'), '/').'/';

        parent::__construct($magento);
    }

    /**
     * Dynamic call to passthrough.
     *
     * @param string $method
     * @param array $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        if (in_array($method, self::HTTP_METHODS)) {
            $args[0] = (isset($args[0]))
                ? $this->endpoint.ltrim($args[0], '/')
                : rtrim($this->endpoint, '/');
        }

        return call_user_func_array([$this, $method], $args);
    }
}
