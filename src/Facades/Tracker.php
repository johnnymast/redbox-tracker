<?php


namespace Redbox\Tracker\Facades;
use Illuminate\Support\Facades\Facade;

class Tracker extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'redbox-tracker-tracker';
    }
}