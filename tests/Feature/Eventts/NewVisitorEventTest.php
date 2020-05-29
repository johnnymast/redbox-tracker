<?php

/**
 * NewVisitorEventTest.php
 *
 * This file contains tests if NewVisitorEventTest is fired.
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

use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
use Redbox\Tracker\Events\NewVisitorEvent;
use Redbox\Tracker\Middleware\TrackingMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Redbox\Tracker\Tests\TestCase;

/**
 * Class NewVisitorEventTest
 *
 * @category Tests
 * @package  RedboxTracker
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-tracker
 * @since    GIT:1.0
 */
class NewVisitorEventTest extends TestCase
{
    use RefreshDatabase;
    
    
    /**
     * Test to see if NewVisitorEvent is sent on detection.
     *
     * @test
     *
     * @return void
     */
    public function test_event_is_fired_on_detection()
    {
        Event::fake();
        
        config()->set('redbox-tracker.track_unauthenticated_visitors', true);
        config()->set('redbox-tracker.track_authenticated_visitors', false);
        
        Route::get(
            'test-middleware', function (Request $request) {
                $this->assertContains('visitor', $request->toArray());
            }
        )->middleware(TrackingMiddleware::class);
        
        $this->get('test-middleware');
        
        
        Event::assertDispatched(NewVisitorEvent::class);
    }
}
