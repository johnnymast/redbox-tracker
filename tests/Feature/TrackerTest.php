<?php

/**
 * TrackerTest.php
 *
 * This file contains tests for the Tracker class.
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

namespace Redbox\Tracker\Tests;

use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Routing\Router;
use Redbox\Tracker\Middleware\TrackingMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

//https://github.com/spatie/laravel-multitenancy/blob/master/tests/TestCase.php
https://github.com/laravel/passport/blob/1d508bbe745b089994ec468666be560708fed11d/tests/Feature/ActingAsClientTest.php

/**
 * Class TrackerTest
 *
 * @category Tests
 * @package  RedboxTracker
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-tracker
 * @since    GIT:1.0
 */
class TrackerTest extends TestCase
{
    use RefreshDatabase;
    
    
    /**
     * Test to see if non authenticated visitors are tracked if option
     * track_unauthenticated_visitors is set to true.
     *
     * @test
     */
    public function test_track_unauthenticated_visitors_true_should_track_visitors()
    {
        config()->set('redbox-tracker.track_unauthenticated_visitors', true);
        config()->set('redbox-tracker.track_authenticated_visitors', false);
        
        Route::get('test-middleware', function (Request $request) {
            $this->assertContains('visitor', $request->toArray());
        })->middleware(TrackingMiddleware::class);
        
        
        $this->get('test-middleware');
    }
    
    /**
     * Test to see if non authenticated visitors are note tracked if option
     * track_unauthenticated_visitors is set to false.
     *
     * @test
     */
    public function test_track_unauthenticated_visitors_false_should_not_track_visitors()
    {
        config()->set('redbox-tracker.track_unauthenticated_visitors', false);
        config()->set('redbox-tracker.track_authenticated_visitors', false);
        
        Route::get('test-middleware', function (Request $request) {
            $this->assertNotContains('visitor', $request->toArray());
        })->middleware(TrackingMiddleware::class);
        
        
        $this->get('test-middleware');
    }
    
    
    /**
     * Test to see if authenticated visitors are tracked if option
     * track_authenticated_visitors is set to true.
     *
     * @test
     */
    public function test_track_authenticated_visitors_true_should_track_visitors()
    {
        config()->set('redbox-tracker.track_unauthenticated_visitors', false);
        config()->set('redbox-tracker.track_authenticated_visitors', true);
        
        Route::get('test-middleware', function (Request $request) {
            $this->assertContains('visitor', $request->toArray());
        })->middleware(TrackingMiddleware::class);
        
        $user = new User();
        $this
          ->actingAs($user)
          ->get('test-middleware');
    }
    
    /**
     * Test if we are not tracking visitors if they are logged in but option
     * track_authenticated_visitors is set to false.
     */
    public function test_track_authenticated_visitors_false_should_not_track_visitors()
    {
        config()->set('redbox-tracker.track_unauthenticated_visitors', false);
        config()->set('redbox-tracker.track_authenticated_visitors', false);
        
        Route::get('test-middleware', function (Request $request) {
            $this->assertNotContains('visitor', $request->toArray());
        })->middleware(TrackingMiddleware::class);
        
        $user = new User();
        $this
          ->actingAs($user)
          ->get('test-middleware');
    }
    
    
    /**
     * Test to see if visitors are stored in the session if tracking is enabled.
     */
    function test_visitor_is_stored_in_session_if_tracking()
    {
        config()->set('redbox-tracker.track_unauthenticated_visitors', true);
        config()->set('redbox-tracker.track_authenticated_visitors', false);
        
        Route::get('test-middleware', function () {
        })->middleware(TrackingMiddleware::class);
        
        
        $this->get('test-middleware');
        $this->assertTrue(\session()->has('visitor'));
    }
    
    /**
     * Test to see if visitors are not stored in the session if tracking is disabled.
     */
    
    function test_visitor_is_not_stored_in_session_if_not_tracking()
    {
        config()->set('redbox-tracker.track_unauthenticated_visitors', false);
        config()->set('redbox-tracker.track_authenticated_visitors', false);
        
        Route::get('test-middleware', function () {
        })->middleware(TrackingMiddleware::class);
        
        
        $this->get('test-middleware');
        $this->assertFalse(\session()->has('visitor'));
    }
    
    
    function test_is_user_has_one_request_at_detection()
    {
        config()->set('redbox-tracker.track_unauthenticated_visitors', true);
        config()->set('redbox-tracker.track_authenticated_visitors', false);
    
        Route::get('test-middleware', function () {
        })->middleware(TrackingMiddleware::class);
        
        $this->get('test-middleware');
    
        if (session()->has('visitor')) {
            $visitor = session()->get('visitor');
            $this->assertTrue($visitor->requests and $visitor->requests->count() > 0);
        } else {
            $this->fail('visitor was not stored in session');
        }
    }


}
