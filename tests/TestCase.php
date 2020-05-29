<?php

/**
 * TestCase.php
 *
 * In order to test the package we have a few prerequisites to bootstrap. This file
 * file contains the base class for the tests.
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

use Orchestra\Testbench\TestCase as Orchestra;
use Redbox\Tracker\Providers\TrackerServiceProvider;

/**
 * TestCase class
 *
 * BaseClass for our tests.
 *
 * @category Tests
 * @package  RedboxTracker
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-tracker
 * @since    GIT:1.0
 */
abstract class TestCase extends Orchestra
{
    
    
    /**
     * Initialize Orchestra.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        
        $this->withFactories(__DIR__.'/../database/factories');
        $this->migrateDb();
    }
    
    
    /**
     * Link the package service provider.
     *
     * @param \Illuminate\Foundation\Application $app The Application
     *
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
          TrackerServiceProvider::class,
        ];
    }
    
    /**
     * Setup the database for the tests.
     *
     * @param \Illuminate\Foundation\Application $app The Application
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'testdb');
        $app['config']->set(
            'database.connections.testdb', [
            'driver' => 'sqlite',
            'database' => ':memory:'
            ]
        );
    }
    
    /**
     * Migrate the database.
     *
     * @return void
     */
    protected function migrateDb(): void
    {
        $migrationsPath = realpath(__DIR__.'/../database/migrations');
        $migrationsPath = str_replace('\\', '/', $migrationsPath);
        
        $this
            ->artisan("migrate --database=testdb --path={$migrationsPath} --realpath")
            ->assertExitCode(0);
    }
}
