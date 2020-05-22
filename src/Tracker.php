<?php

/**
 * Tracker.php
 *
 * This Facade is doing the actual tracking for the package. The tracker is
 * instantiated by the TrackingMiddleware. Based on the rules defined in the
 * tracker.php configuration file it will track (or not track) visitors on your
 * website.
 *
 * This project is heavily inspired by Laravel Visitor Tracker and this file is
 * where most of the source is almost identical to that project.
 *
 * [Laravel Visitor Tracker](https://github.com/voerro/laravel-visitor-tracker)
 *
 * PHP version 7.2
 *
 * @category Facades
 * @package  RedboxTracker
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-tracker
 * @since    GIT:1.0
 */

namespace Redbox\Tracker;

use DeviceDetector\DeviceDetector;
use Redbox\Tracker\Events\NewVisitorNotification;

/**
 * Tracker class
 *
 * Facade for tracking website visitors.
 *
 * @category Facades
 * @package  RedboxTracker
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-tracker
 * @since    GIT:1.0
 */
class Tracker
{

    /**
     * Tracker constructor.
     */
    public function __construct()
    {
        $this->dd = new DeviceDetector(request()->header('User-Agent'));
        $this->dd->parse();
    }

    /**
     * Record the visit can create a new record if needed.
     *
     * @return bool
     */
    public function recordVisit(): bool
    {
        $config = config('redbox-tracker');
        $user = request()->user();
        $routeName = request()->route()->getName();
        $methodName = request()->getMethod();

//        session()->forget('visitor'); return true;
        /**
         * Check if we should skip the current round.
         */
        if (in_array($routeName, $config['skip_routes'])) {
            return false;
        }

        /**
         * If the request method is not in the allowed methods
         * array return false.
         */
        if (!in_array($methodName, $config['allowed_methods'])) {
            return false;
        }

        /**
         * If we are not allowed to tracked authenticated users return false.
         */
        if ($config['track_authenticated_users'] == false && $user) {
            return false;
        }

        /**
         * If we are not allowed to tracked authenticated users return false.
         */
        if ($config['track_unauthenticated_users'] == false && !$user) {
            return false;
        }

        if (session()->has('visitor') === true) {
            $visitor = session()->get('visitor');
            $visitor = Visitor::find($visitor['id']);
        } else {
            $visitor = new Visitor();
        }

        $visitor->fill($this->collect());

        if ($visitor->exists === false) {
            if ($config['events']['dispatch']) {
                event(new NewVisitorNotification($visitor));
            }
        }
        event(new NewVisitorNotification($visitor));
        $visitor->save();

        $visitorRequest = new VisitorRequest();
        $visitorRequest->visitor_id = $visitor['id'];
        $visitorRequest->domain = request()->getHttpHost();
        $visitorRequest->method = $methodName;
        $visitorRequest->route = $routeName;
        $visitorRequest->referer = request()->headers->get('Referer');
        $visitorRequest->is_secure = request()->isSecure();
        $visitorRequest->is_ajax = \request()->ajax();
        $visitorRequest->path = request()->path() ?? '';

        $visitor->requests()->save($visitorRequest);

        request()->merge(['visitor' => $visitor]);
        session()->put('visitor', $visitor->toArray());

        return true;
    }

    /**
     * Collect Visitor information so we can store i with the visitor.
     *
     * @return array
     */
    public function collect(): array
    {
        $request = request();

        return [
          'ip' => $request->ip(),
          'user_id' => $request->user()->id ?? 0,
          'user_agent' => $request->userAgent(),
          'is_mobile' => (int)$this->dd->isMobile(),
          'is_desktop' => (int)$this->dd->isDesktop(),
          'is_bot' => (int)$this->dd->isBot(),
          'bot' => $this->dd->getBot()['name'] ?? '',
          'os' => $this->dd->getOs('name'),
          'browser_version' => $this->dd->getClient('version'),
          'browser' => $this->dd->getClient('name')
        ];
    }
}
