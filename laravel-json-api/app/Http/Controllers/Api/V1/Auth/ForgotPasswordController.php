<?php

namespace App\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;
use CloudCreativity\LaravelJsonApi\Document\Error;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;

class ForgotPasswordController extends JsonApiController
{
    use SendsPasswordResetEmails;

    /**
     * Handle the incoming request.
     * We overwrite this method to enable correct json:api response
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function __invoke(Request $request)
    {
        try {
            $response = Password::sendResetLink($request->only('email'), function (Message $message) {
                $message->subject($this->getEmailSubject());
            });

            switch ($response) {
                case Password::RESET_LINK_SENT:
                    return response()->json([], 204);
                case Password::INVALID_USER:
                    return $this->reply()->errors(Error::create([
                        'title' => 'Bad Request',
                        'detail' => trans($response),
                        'status' => '400',
                        'meta' => [
                            'key' => 'email',
                            'pointer' => '/data/attributes/email'
                        ]
                    ]));
            }
        } catch (\Exception $ex) {
            return $this->reply()->errors(Error::create([
                'title' => 'Bad Request',
                'detail' => $ex->getMessage(),
                'status' => '400',
            ]));
        }
    }
}
