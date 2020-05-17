<?php

namespace Redbox\Tracker\Middleware;

use Redbox\Tracker\Facades\Tracker;
use Closure;

class TrackingMiddleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        //
    ];
    
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
        Tracker::recordVisit();
        
        return $next($request);
    }
}
