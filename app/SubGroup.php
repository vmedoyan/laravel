<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubGroup extends Model
{
    protected $table = 'subgroups';
    public $timestamps = false;

    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id');
    }

    public function objects()
    {
        return $this->hasMany('App\Object', 'subgroup_id');
    }

    public function object()
    {
        return $this->hasOne('App\Object', 'subgroup_id');
    }
}
