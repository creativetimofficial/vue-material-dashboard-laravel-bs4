<?php

namespace Grayloon\Magento\Api;

class Integration extends AbstractApi
{
    /**
     * Create access token given the customer credentials.
     *
     * @param  string  $username
     * @param  string  $password
     * @return array
     */
    public function customerToken($username, $password)
    {
        return $this->post('/integration/customer/token', [
            'username' => $username,
            'password' => $password,
        ]);
    }

    /**
     * Create access token given the admin credentials.
     *
     * @param  string  $username
     * @param  string  $password
     * @return array
     */
    public function adminToken($username, $password)
    {
        return $this->post('/integration/admin/token', [
            'username' => $username,
            'password' => $password,
        ]);
    }
}
