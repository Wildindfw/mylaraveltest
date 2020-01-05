<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class ValidarToken
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
        if (Auth::check())
            return $next($request);

        $apiToken = $request->header('Authorization');
        if (empty($apiToken)) 
            return response()->json([], 401);

        $user = User::where('api_token', hash('sha256', $apiToken))->first();

        if (empty($user))
            return response()->json([], 401);

        Auth::loginUsingId($user->id);

        return $next($request);
    }
}
