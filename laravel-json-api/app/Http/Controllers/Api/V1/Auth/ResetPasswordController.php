<?php

namespace App\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use CloudCreativity\LaravelJsonApi\Document\Error;
use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;

class ResetPasswordController extends JsonApiController
{
    use ResetsPasswords;

    /**
     * Handle the incoming request.
     * We overwrite this method to enable correct json:api response
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        try {
            $request->validate($this->rules(), $this->validationErrorMessages());

            // Here we will attempt to reset the user's password. If it is successful we
            // will update the password on an actual user model and persist it to the
            // database. Otherwise we will parse the error and return the response.
            $response = $this->broker()->reset(
                $this->credentials($request),
                function ($user, $password) {
                    $this->resetPassword($user, $password);
                }
            );

            // If the password was successfully reset, we will redirect the user back to
            // the application's home authenticated view. If there is an error we can
            // redirect them back to where they came from with their error message.
            switch ($response) {
                case Password::PASSWORD_RESET:
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
                case Password::INVALID_TOKEN:
                    return $this->reply()->errors(Error::create([
                        'title' => 'Bad Request',
                        'detail' => trans($response),
                        'status' => '400',
                        'meta' => [
                            'key' => 'token',
                            'pointer' => '/data/attributes/token'
                        ]
                    ]));
            }
        } catch (\Exception $e) {
            return $this->reply()->errors(Error::create([
                'title' => 'Bad Request',
                'detail' => $e->getMessage(),
                'status' => '400',
            ]));
        }
    }

    /**
     * Reset the given user's password.
     * We overwrite this method since we are stateless so the login and rember token
     * are no longer needed after password reset
     * Also we have a mutator on user model that automatically hashes the password
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->password = $password;
        $user->save();

        event(new PasswordReset($user));
    }
}
