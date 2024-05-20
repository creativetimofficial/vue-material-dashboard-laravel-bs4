<?php

namespace App\Http\Controllers\Api\V2\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V2\Auth\RegisterRequest;
use LaravelJsonApi\Core\Document\Error;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Api\V2\Auth\LoginRequest;
use App\Models\User;

class RegisterController extends Controller
{
        /**
     * Handle the incoming request.
     *
     * @param \App\Http\Requests\Api\V2\Auth\RegisterRequest $request
     *
     * @return \Symfony\Component\HttpFoundation\Response|\LaravelJsonApi\Core\Document\Error
     * @throws \Exception
     */
    public function __invoke(RegisterRequest $request): Response|Error
    {
        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => $request->password,
        ]);

        return (new LoginController)(new LoginRequest($request->only(['email', 'password'])));
    }
}
