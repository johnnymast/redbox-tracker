<?php

namespace Redbox\Tracker\Providers;

use Illuminate\Support\ServiceProvider;
use Redbox\Tracker\Middleware\TrackingMiddleware;
use Redbox\Tracker\Observers\Visitor as VisitorObserver;
use Redbox\Tracker\Tracker;
use Redbox\Tracker\Visitor;

class TrackerServiceProvider extends ServiceProvider
{

    /**
     * Register the publishable files.
     */
    private function registerPublishableResources(): void
    {
        $path = dirname(__DIR__).'/../../publishable';

        $publishable = [
          'translations' => [
            "{$path}/config/lang" => resource_path('lang/vendor/redbox-tracker'),
          ],
          'config' => [
            "{$path}/config/tracker.php" => config_path('tracker.php'),
          ],
        ];

        foreach ($publishable as $group => $paths) {
            $this->publishes($paths, $group);
        }
    }


    public function register(): void
    {
        $this->app->singleton(
            Tracker::class,
            function () {
                return new Tracker();
            }
        );

        $this->app->alias(Tracker::class, 'redbox-tracker-tracker');

        if ($this->app->config->get('redbox-tracker') === null) {
            $this->app->config->set(
                'redbox-tracker',
                require __DIR__.'/../../publishable/config/tracker.php'
            );
        }

        if ($this->app->runningInConsole()) {
            $this->registerPublishableResources();
        }
        $middlewareGroups = config('redbox-tracker.middleware.attach');

        foreach ($middlewareGroups as $group) {
            app('router')->pushMiddlewareToGroup($group, TrackingMiddleware::class);
        }
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'tracker');
        $this->loadMigrationsFrom(realpath(__DIR__.'/../../migrations'));

        Visitor::observe(VisitorObserver::class);
    }
}
