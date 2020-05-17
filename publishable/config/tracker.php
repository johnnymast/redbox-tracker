<?php

return [

  'middleware' => [
    'attach' => ['web'],
    'track' => ['guest']
  ],

  'track_authenticated_users' => false,
  'track_unauthenticated_users' => true,
  'track_bots' => true,

  'allowed_methods' => [
    'HEAD' => false,
    'POST' => true,
    'PUT' => true,
    'GET' => true,
  ],


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