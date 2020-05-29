<?php

/**
 * VisitorObserverTest.php
 *
 * This file contains tests if the Visitor Observer if
 * the creating event is fired.
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

namespace Redbox\Tracker\Tests\Feature\Events;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Redbox\Tracker\Middleware\TrackingMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Redbox\Tracker\Tests\TestCase;

/**
 * Class VisitorObserverTest
 *
 * @category Tests
 * @package  RedboxTracker
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-tracker
 * @since    GIT:1.0
 */
class VisitorObserverTest extends TestCase
{
    use RefreshDatabase;
    
    
    /**
     * Test to see if NewVisitorEvent is sent on detection.
     *
     * @test
     *
     * @return void
     */
    public function test_if_creating_event_is_observed_by_the_observer()
    {
        config()->set('redbox-tracker.track_unauthenticated_visitors', true);
        config()->set('redbox-tracker.track_authenticated_visitors', false);
        
        $didFire = false;
        
        Route::get(
            'test-middleware', function (Request $request) {
                //
            }
        )->middleware(TrackingMiddleware::class);
        
        Event::listen(
            'eloquent.creating: Redbox\Tracker\Visitor', function () use (&$didFire) {
                $didFire = true;
            }
        );
        
        
        $this->get('test-middleware');
        
        $this->assertTrue($didFire);
    }
}
