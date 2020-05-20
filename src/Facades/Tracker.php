<?php

/**
 * Tracker.php
 *
 * Laravel identification for the Tracker Facade defined in
 * TrackerServiceProvider.php.
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

namespace Redbox\Tracker\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Tracker
 *
 * Identifies the Tracker Facade.
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
class Tracker extends Facade
{

    /**
     * Define the alias for this Tracker Facade.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'redbox-tracker-tracker';
    }
}
