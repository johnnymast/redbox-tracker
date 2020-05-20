<?php

namespace Redbox\Tracker\Middleware;

use Redbox\Tracker\Facades\Tracker;
use Closure;

class TrackingMiddleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure                  $next
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
        Tracker::recordVisit();

        return $next($request);
    }
}
