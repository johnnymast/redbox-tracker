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

namespace Redbox\Tracker\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Redbox\Tracker\Middleware\TrackingMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

//https://github.com/spatie/laravel-multitenancy/blob/master/tests/TestCase.php
https://github.com/laravel/passport/blob/1d508bbe745b089994ec468666be560708fed11d/tests/Feature/ActingAsClientTest.php

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
    
    // $user = new User(['name' => 'Admin']);
    
    public function test_track_authenticated_visitors_false_should_not_track_visitors()
    {
        $this->withoutExceptionHandling();
        
        config()->set('redbox-tracker.track_authenticated_visitors', false);
        
        Route::get('test-middleware', function (Request $request) {
            $this->assertNotContains('visitor', $request->toArray());
        })
          ->middleware(['web', TrackingMiddleware::class]);
//
        $this->get('/test-middleware');
    }

//
//    public function test_track_authenticated_visitors_true_should_track_visitors()
//    {
//        $this->withoutExceptionHandling();
//
//        config()->set('redbox-tracker.track_authenticated_visitors', true);
//
//        Route::get(
//          'test-middleware',
//          function (Request $request) {
//              $this->assertContains('visitor', $request->toArray());
//          }
//        )->middleware(['web', TrackingMiddleware::class]);
//
//        $this->get('/test-middleware');
//    }

//
//
//    /*
//     *
//     */
//
//
//    public function test_track_unauthenticated_visitors_false_should_not_track_visitors(
//    )
//    {
//        $this->assertActionUsesMiddleware(
//          \App\Http\Controllers\VideoController::class,
//          'show',
//          'add-ons'
//        );
//    }
//
//    public function test_track_unauthenticated_visitors_true_should_not_track_visitors(
//    )
//    {
//        $this->assertActionUsesMiddleware(
//          \App\Http\Controllers\VideoController::class,
//          'show',
//          'add-ons'
//        );
//    }
}
