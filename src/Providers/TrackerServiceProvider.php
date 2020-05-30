<?php

/**
 * TrackerServiceProvider.php
 *
 * The main purpose of this service provider is to make sure laravel
 * knows where our publishable resources are in our package.
 *
 * PHP version 7.2
 *
 * @category Providers
 * @package  RedboxTracker
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-tracker
 * @since    GIT:1.0
 */

namespace Redbox\Tracker\Providers;

use Illuminate\Support\ServiceProvider;
use Redbox\Tracker\Middleware\TrackingMiddleware;
use Redbox\Tracker\Observers\VisitorObserver as VisitorObserver;
use Redbox\Tracker\Tracker;
use Redbox\Tracker\Visitor;

/**
 * Class TrackerServiceProvider
 *
 * @category Providers
 * @package  RedboxTracker
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-tracker
 * @since    GIT:1.0
 */
class TrackerServiceProvider extends ServiceProvider
{
    
    /**
     * Register the publishable files.
     *
     * @return void
     */
    private function registerPublishableResources(): void
    {
        $path = dirname(__DIR__).'./../../publishable';
        
        $publishable = [
          'config' => [
            "{$path}/config/tracker.php" => config_path('tracker.php'),
          ],
        ];
        
        foreach ($publishable as $group => $paths) {
            $this->publishes($paths, $group);
        }
    }
    
    /**
     * Register configurations and facade(s).
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(
            Tracker::class,
            function () {
                return new Tracker();
            }
        );
        
        $this->app->alias(Tracker::class, 'redbox-tracker-tracker');
        
        if (config()->get('redbox-tracker') === null) {
            config()->set(
                'redbox-tracker',
                include __DIR__.'./../../publishable/config/tracker.php'
            );
        }
        
        if ($this->app->runningInConsole()) {
            $this->registerPublishableResources();
        }
    }
    
    /**
     * Tell Laravel where to look for the package it's migrations.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(realpath(__DIR__.'/../database/migrations'));
        
        $middlewareGroups = config('redbox-tracker.middleware.attach');
        
        foreach ($middlewareGroups as $group) {
            app('router')->pushMiddlewareToGroup($group, TrackingMiddleware::class);
        }
        
        Visitor::observe(VisitorObserver::class);
    }
}
