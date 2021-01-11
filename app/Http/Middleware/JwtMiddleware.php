<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            auth()->userOrFail();
        } catch (UserNotDefinedException $e) {
            return response()->json(['status' => 'User could not be authenticated. Access denied'], 401);
        }
        return $next($request);
    }
}
