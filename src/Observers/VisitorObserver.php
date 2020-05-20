<?php

/**
 * VisitorObserver.php
 *
 * Observers the creation of new Visitor objects to the database.
 * Upon creation it will add a unique identifier to the new Visitor.
 *
 * PHP version 7.2
 *
 * @category Observers
 * @package  RedboxTracker
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-tracker
 * @since    GIT:1.0
 */

namespace Redbox\Tracker\Observers;

/**
 * Class VisitorObserver
 *
 * @category Observers
 * @package  RedboxTracker
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-tracker
 * @since    GIT:1.0
 */
class VisitorObserver
{

    /**
     * Create a mew unique identifier for the new visitor.
     *
     * @param VisitorObserver $visitor The visitor that is about to be created.
     *
     * @return void
     */
    public function creating($visitor): void
    {
        $visitor->unique_id = \Redbox\Tracker\Visitor::createUniqueID();
    }
}
