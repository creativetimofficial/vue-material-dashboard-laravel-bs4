<?php

namespace App\Http\Controllers\Api\V2\Auth;

use App\Http\Requests\Api\V2\Auth\ForgotPasswordRequest;
use Illuminate\Support\Facades\Password;
use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;

class ForgotPasswordController extends JsonApiController
{
     /**
     * Handle the incoming request.
     * We overwrite this method to enable correct json:api response
     *
     * @param ForgotPasswordRequest $request
     */
    public function __invoke(ForgotPasswordRequest $request)
    {
        try {
            $response = Password::sendResetLink(
                $request->only('email')
            );
            switch ($response) {
                case Password::RESET_LINK_SENT:
                    return response()->json([], 204);
                case Password::INVALID_USER:
                    return $this->reply()->errors([
                        Error::fromArray([
                            'title' => 'Bad Request',
                            'detail' => trans($response),
                            'status' => '400',
                            'source' => [
                              'pointer' => '/data/attributes/email'
                            ],
                            'meta' => [
                                'failed' => [
                                    'rule' => 'exists'
                                ]
                            ]
                        ])
                    ]);
           }
        } catch (Throwable $ex) {
            return $this->reply()->errors([
                Error::fromArray([
                    'title' => 'Bad Request',
                    'detail' => $ex->getMessage(),
                    'status' => '400',
                ])
            ]);
        }
    }

}
