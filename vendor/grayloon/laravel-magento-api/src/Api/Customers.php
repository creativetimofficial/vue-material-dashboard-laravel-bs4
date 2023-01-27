<?php

namespace Grayloon\Magento\Api;

class Customers extends AbstractApi
{
    /**
     * The list of customers.
     *
     * @param  int  $pageSize
     * @param  int  $currentPage
     * @param  array  $filters
     *
     * @return  array
     */
    public function all($pageSize = 50, $currentPage = 1, $filters = [])
    {
        return $this->get('/customers/search', array_merge($filters, [
            'searchCriteria[pageSize]'    => $pageSize,
            'searchCriteria[currentPage]' => $currentPage,
        ]));
    }

    /**
     * Create customer account. Perform necessary business operations like sending email.
     *
     * @param  array  $body
     * @return array
     */
    public function create($body)
    {
        return $this->post('/customers', $body);
    }

    /**
     * Send an email to the customer with a password reset link.
     *
     * @param string $email
     * @param string $template
     * @param id     $websiteId
     * @return array
     */
    public function password($email, $template, $websiteId)
    {
        return $this->put('/customers/password', [
            'email'     => $email,
            'template'  => $template,
            'websiteId' => $websiteId,
        ]);
    }

    /**
     * Reset customer password.
     *
     * @param  string  $email
     * @param  string  $resetToken
     * @param  string  $newPassword
     * @return void
     */
    public function resetPassword($email, $resetToken, $newPassword)
    {
        return $this->post('/customers/resetPassword', [
            'email'       => $email,
            'resetToken'  => $resetToken,
            'newPassword' => $newPassword,
        ]);
    }
}
