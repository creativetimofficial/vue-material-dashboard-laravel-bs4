<?php

namespace App\JsonApi\V1\Users;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'users';

    /**
     * @param object $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param object $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
            'name' => $resource->name,
            'email' => $resource->email,
            'created_at' => optional($resource->created_at)->format("Y-m-d H:s:i"),
            'updated_at' => optional($resource->updated_at)->format("Y-m-d H:s:i"),
        ];
    }
}
