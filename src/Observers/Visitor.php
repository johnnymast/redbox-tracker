<?php


namespace Redbox\Tracker\Observers;


class Visitor
{
    
    public function creating($visitor)
    {
        $visitor->unique_id = \Redbox\Tracker\Visitor::createUniqueID();
    }
    
}