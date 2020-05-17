<?php

namespace Redbox\Tracker;

use Illuminate\Database\Eloquent\Model;
use Redbox\Tracker\VisitorRequest;

/**
 * Visitor Status
 *
 * Model for website visitors.
 *
 * PHP version 7.2
 *
 * @category Statistics
 * @package  Alexia
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/alexia
 * @since    GIT:1.0
 */
class Visitor extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'visitor_id',
      'user_id',
      'user_agent',
      'browser_version',
      'browser',
      'ip',
      'os'
    ];

    /**
     * Return a new unique id for a visitor.
     *
     * @return int|void
     */
    public static function createUniqueID()
    {
        $number = mt_rand(1000000000, 9999999999); // better than rand()

        if (self::uniqueIdExists($number)) {
            return self::createUniqueID();
        }

        return $number;
    }

    /**
     * Check to see if a unique id already exists in
     * the database.
     *
     * @param string $id The unique id to check for
     *
     * @return mixed
     */
    public static function uniqueIdExists($id)
    {
        return Visitor::whereUniqueId($id)->exists();
    }

    public function requests()
    {
        return $this->hasMany(VisitorRequest::class);
    }
}
