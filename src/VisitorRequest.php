<?php

namespace Redbox\Tracker;

use Illuminate\Database\Eloquent\Model;

/**
 * VisitorRequest class
 *
 * Model for website visitor requests.
 *
 * PHP version 7.2
 *
 * @category Models
 * @package  redbox-tracker
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/alexia
 * @since    GIT:1.0
 */
class VisitorRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'unique_id',
      'domain',
      'method',
      'path',
      'route',
      'referer',
      'is_secure',
      'is_ajax'
    ];


    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}
