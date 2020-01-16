<?php

namespace App\Http\Middleware;

use App\Models\Security\BlockedDriver;
use Closure;

class CheckDriverIsBloced
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
        if ( BlockedDriver::isBlocked() ) {
            return response()->json(['status' => 'Blocked']);
        }
        return $next($request);
    }
}
