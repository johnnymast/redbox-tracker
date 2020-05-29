<?php

/**
 * TrackingMiddlewareTest.php
 *
 * This file contains tests for the TrackingMiddleware.
 *
 * PHP version 7.2
 *
 * @category Tests
 * @package  RedboxTracker
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-tracker
 * @since    GIT:1.0
 */

namespace Redbox\Tracker\Tests\Feature\Middleware;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Redbox\Tracker\Middleware\TrackingMiddleware;
use Illuminate\Support\Facades\Route;
use Redbox\Tracker\Tests\TestCase;
use Illuminate\Http\Request;

/**
 * Class TrackingMiddlewareTest
 *
 * @category Tests
 * @package  RedboxTracker
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-tracker
 * @since    GIT:1.0
 */
class TrackingMiddlewareTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Test if the middleware is being used if the web middleware
     * group has been used.
     *
     * @return void
     */
    public function test_should_be_used_with_web_middleware_group(): void
    {
        $this->withoutExceptionHandling();
        
        $router = resolve(\Illuminate\Routing\Router::class);
        $middleWareGroups = $router->getMiddlewareGroups();
        
        Route::get(
            'test-middleware', function (Request $request) use ($middleWareGroups) {
                $routeMiddleWareGroups = $request->route()->gatherMiddleware();
                $found = false;
            
                foreach ($routeMiddleWareGroups as $groupName) {
                    if (isset($middleWareGroups[$groupName]) === true) {
                        $group = $middleWareGroups[$groupName];
                    
                        if (in_array(TrackingMiddleware::class, $group)) {
                            $found = true;
                        }
                    }
                }
            
                $this->assertTrue($found);
            }
        )->middleware('web');
        //
        
        $this->get('/test-middleware');
    }
}
