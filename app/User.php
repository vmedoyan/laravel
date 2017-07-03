<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    public $timestamps = false;

    public function objects()
    {
        return $this->belongsToMany('App\Object', 'user_object', 'user_id', 'object_id');
    }
}
