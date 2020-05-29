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
     */
    public function setUp(): void
    {
        parent::setUp();
        
        $this->withFactories(__DIR__ . '/../database/factories');
    }
    
    /**
     * Link the package service provider.
     *
     * @param  \Illuminate\Foundation\Application  $app
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
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'testdb');
        $app['config']->set('database.connections.testdb', [
          'driver' => 'sqlite',
          'database' => ':memory:'
        ]);
    }
}
