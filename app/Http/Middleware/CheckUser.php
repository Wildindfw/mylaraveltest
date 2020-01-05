<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class CheckUser
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
        if (empty($request->idUser)) {
            return response()->json(['message' => 'User not found.', 403]);
        }

        if (!User::find($request->idUser)) {
            return response()->json(['message' => 'User don\'t exist'], 403);
        }

        return $next($request);
    }
}
