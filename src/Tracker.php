<?php

namespace Redbox\Tracker;

use DeviceDetector\DeviceDetector;

class Tracker
{

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

//        session()->forget('visitor');
//        return true;

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
         * Return false if the method is not allowed.
         */
        if ($config['allowed_methods'] === false && $this->dd->isBot() == true) {
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
