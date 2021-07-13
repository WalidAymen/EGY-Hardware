<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class apiIsBookkeeper
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
        $logedUser = $request->user();
        if ($logedUser->role == 'admin' || $logedUser->role == 'super_admin' || $logedUser->role == 'bookkeeper') {
            return $next($request);
        }
        return response()->json(['msg' => 'you must be bookkeeper'], 406);
    }
}
