<?php

namespace Redbox\Tracker\Providers;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Routing\Router;
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
    private function registerPublishableResources()
    {
        $path = dirname(__DIR__).'/../../publishable';

        $publishable = [
          'translations' => [
            "{$path}/config/lang" => resource_path('lang/vendor/redbox-tracker'),
          ],
          'config' => [
            "{$path}/config/canyon.php" => config_path('tracker.php'),
          ],
        ];

        foreach ($publishable as $group => $paths) {
            $this->publishes($paths, $group);
        }
    }


    public function register()
    {
        $this->app->singleton(Tracker::class, function () {
            return new Tracker();
        }
        );

        $this->app->alias(Tracker::class, 'redbox-tracker-tracker');
//        $this->app->alias(Identify::class, 'laravel-identify');

        if ($this->app->config->get('redbox-tracker') === null) {
            $this->app->config->set('redbox-tracker',
              require __DIR__.'/../../publishable/config/tracker.php');
        }

        if ($this->app->runningInConsole()) {
            $this->registerPublishableResources();
        }
        $middlewareGroups = config('redbox-tracker.middleware.attach');

        foreach ($middlewareGroups as $group) {
            app('router')->pushMiddlewareToGroup($group, TrackingMiddleware::class);
        }


    }

    public function boot(Router $router, Dispatcher $event)
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'tracker');
        $this->loadMigrationsFrom(realpath(__DIR__.'/../../migrations'));

        Visitor::observe(VisitorObserver::class);
    }

}