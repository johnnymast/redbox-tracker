<?php

/**
 * Tracker.php
 *
 * This file contains the configuration for Redbox-tracker.
 *
 * PHP version 7.2
 *
 * @category Configuration
 * @package  RedboxTracker
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-tracker
 * @since    GIT:1.0
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | By default Redbox-tracker automatically attaches it self to the web
    | middleware. You are free to change this to any middleware group alias for
    | example auth or any custom group you might have created.
    |
    */
  'middleware' => [
    'attach' => ['web']
  ],


    /*
    |--------------------------------------------------------------------------
    | Broadcasting Events
    |--------------------------------------------------------------------------
    |
    | Once a new visitor has been created a NewVisitorNotification event will
    | be broadcasted. You can choose to disable this or configure your own event.
    |
    | Please note: If you to broadcast your own event make sure to accept
    | the visitor information as the first argument.
    */
  'events' => [
    'dispatch' => true,
    'channel' => 'redbox-tracker-new-visitors'
  ],

    /*
    |--------------------------------------------------------------------------
    | Who or what to track
    |--------------------------------------------------------------------------
    |
    | By default we dont track authenticated user accounts in the system but it does
    | track non authenticated users (for example website visitor). If you wish you
    | could change this below.
    |
    */
  'track_authenticated_visitors' => false,
  'track_unauthenticated_visitors' => true,

    /*
    |--------------------------------------------------------------------------
    | HTTP Request methods
    |--------------------------------------------------------------------------
    |
    | If you wish to track different kinds of http request methods you can
    | configure them below.
    |
    */
  'allowed_methods' => [
    'HEAD' => false,
    'POST' => true,
    'PUT' => true,
    'GET' => true,
  ],

    /*
    |--------------------------------------------------------------------------
    | Skipping routes
    |--------------------------------------------------------------------------
    |
    | If you have any routes that should not be tracked you can exclude them here.
    | By default redbox-tracker does not track authentication routes but this
    | can be changed.
    |
    */
  'skip_routes' => [
    'login',
    'logout',
    'register',
    'password.confirm',
    'password.email',
    'password.request',
    'password.update',
    'password.reset',
  ],
];
