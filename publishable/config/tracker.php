<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | By default redbox-tracker automatically attaches it self to the web
    | middleware. You are free to change this to any middleware group alias for
    | example auth or any custom group you might have created.
    |
    */
  'middleware' => [
    'attach' => ['web'],
    'track' => ['guest']
  ],

    /*
    |--------------------------------------------------------------------------
    | Who or what to track
    |--------------------------------------------------------------------------
    |
    | By default we dont track authenticated users in the system but track
    | users (fpr example website visitor) who are not authenticated. If you wish
    | you could change this below.
    |
    */
  'track_authenticated_users' => false,
  'track_unauthenticated_users' => true,

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
