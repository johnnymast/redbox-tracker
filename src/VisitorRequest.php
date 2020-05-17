<?php

namespace Redbox\Tracker;

use Illuminate\Database\Eloquent\Model;
use Redbox\Tracker\Visitor;

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
