<?php

/**
 * VisitorRequest.php
 *
 * This model contains information about requests visitors make
 * on your website. This model is linked by a hasMany on the Visitor model.
 * Every VisitorRequest has one unique visitor record represented by the belongsTo
 * visitor relation.
 *
 * PHP version 7.2
 *
 * @category Models
 * @package  RedboxTracker
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-tracker
 * @since    GIT:1.0
 */

namespace Redbox\Tracker;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

/**
 * VisitorRequest class
 *
 * Model for website visitor requests.
 *
 * @category Models
 * @package  RedboxTracker
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-tracker
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
    
    /**
     * Return the visitor for this request.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function visitor(): BelongsTo
    {
        return $this->belongsTo(Visitor::class);
    }
}
