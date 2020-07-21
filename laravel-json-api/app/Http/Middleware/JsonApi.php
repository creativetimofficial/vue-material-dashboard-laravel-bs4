<?php

namespace App\Http\Middleware;

use Closure;

class JsonApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->has('data')) {
            $input = $request->data['attributes'];
    
            $request->replace($input);
        }

        return $next($request);
    }
}
