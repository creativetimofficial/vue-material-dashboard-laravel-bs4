<?php

namespace App\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        auth()->user()->token()->revoke();

        return response()->json([], 204);
    }
}
