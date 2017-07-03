<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Object extends Model
{
    protected $table = 'objects';

    public $timestamps = false;

    public function subgroup()
    {
        return $this->belongsTo('App\SubGroup', 'subgroup_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_object', 'object_id', 'user_id');
    }
}
