<?php

/**
 * TrackingMiddleware.php
 *
 * This middleware will intercept traffic from visitors to
 * your website.
 *
 * PHP version 7.2
 *
 * @category Middleware
 * @package  RedboxTracker
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-tracker
 * @since    GIT:1.0
 */

namespace Redbox\Tracker\Middleware;

use Redbox\Tracker\Facades\Tracker;
use Closure;

/**
 * TrackingMiddleware class
 *
 * Model for website visitor requests.
 *
 * @category Middleware
 * @package  RedboxTracker
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-tracker
 * @since    GIT:1.0
 */
class TrackingMiddleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request The incoming request
     * @param Closure                  $next    The next Middleware to execute.
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Tracker::recordVisit();
        
        return $next($request);
    }
}
