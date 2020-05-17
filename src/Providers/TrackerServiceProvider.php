<?php
namespace Redbox\Tracker\Providers;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class TrackerServiceProvider extends ServiceProvider
{
    
    
    /**
     * Register the publishable files.
     */
    private function registerPublishableResources()
    {
        $path  = dirname(__DIR__).'/publishable';
        
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
    
    public function boot(Router $router, Dispatcher $event)
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tracker');
    }
    
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishableResources();
        }
    }
    
}