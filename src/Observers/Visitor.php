<?php


namespace Redbox\Tracker\Observers;

class Visitor
{

    /**
     * Create a mew unique identifier for the new visitor.
     *
     * @param Visitor $visitor The visitor that is about to be created.
     */
    public function creating($visitor): void
    {
        $visitor->unique_id = \Redbox\Tracker\Visitor::createUniqueID();
    }
}
