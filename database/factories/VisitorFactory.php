<?php

/**
 * VisitorFactory.php
 *
 * Factory file for Visitors.
 *
 * PHP version 7.2
 *
 * @category Factories
 * @package  RedboxTracker
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-tracker
 * @since    GIT:1.0
 */

/**
 * Define the external $factory instance.
 *
 * @var \Illuminate\Database\Eloquent\Factory $factory
 */

use Redbox\Tracker\Visitor;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(
    Visitor::class,
    function (Faker\Generator $faker) {
        return [
        'user_id' => $faker->numberBetween(1, 100),
        'user_agent' => $faker->userAgent(),
        'browser_version' => 82,
        'browser' => Str::random(10),
        'ip' => $faker->ipv4(),
        'os' => Str::random(15),
        ];
    }
);
