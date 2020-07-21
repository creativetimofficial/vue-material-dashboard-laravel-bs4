<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param RegisterRequest $request
     * @return mixed
     */
    public function __invoke(RegisterRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        $credentials = $request->only(['email', 'password']);

        $loginRequest = new LoginRequest($credentials);

        return (new LoginController)($loginRequest);
    }
}
