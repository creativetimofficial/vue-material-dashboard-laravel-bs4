<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Requests\Api\V1\Auth\ForgotPasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;
use CloudCreativity\LaravelJsonApi\Document\Error\Error;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;
use Throwable;

class ForgotPasswordController extends JsonApiController
{
    use SendsPasswordResetEmails;

    /**
     * Handle the incoming request.
     * We overwrite this method to enable correct json:api response
     *
     * @param ForgotPasswordRequest $request
     * @return JsonResponse|mixed
     */
    public function __invoke(ForgotPasswordRequest $request)
    {
        try {
            $response = Password::sendResetLink(
                $request->only('email'), function (Message $message) {
                    $message->subject($this->getEmailSubject());
                }
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
