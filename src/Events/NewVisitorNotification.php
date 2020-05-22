<?php

/**
 * NewVisitorNotification.php
 *
 * Laravel identification for the Tracker Facade defined in
 * TrackerServiceProvider.php.
 *
 * PHP version 7.2
 *
 * @category Events
 * @package  RedboxTracker
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-tracker
 * @since    GIT:1.0
 */

namespace Redbox\Tracker\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\Channel;
use Redbox\Tracker\Visitor;

/**
 * Class NewVisitorNotification
 *
 * Identifies the Tracker Facade.
 *
 * PHP version 7.2
 *
 * @category Events
 * @package  RedboxTracker
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-tracker
 * @since    GIT:1.0
 */
class NewVisitorNotification
{
    use Dispatchable;
//    use InteractsWithSockets;
  //  use SerializesModels;


    /**
     * @var Visitor $visitor the new visitor
     */
    public $visitor;

    /**
     * Create a new event instance.
     *
     * @param Visitor $visitor The newly created visitor.
     */
    public function __construct(Visitor $visitor)
    {
        $this->visitor = $visitor;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return PrivateChannel
     */
    public function broadcastOn()
    {
        return new PrivateChannel(config('redbox-tracker.events.channel'));
    }
}
