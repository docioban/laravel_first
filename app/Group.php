<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';
    public $primaryKey = 'id';
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany('App\User', 'users_groups', 'group_id','user_id');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Permission', 'groups_permissions', 'group_id','permission_id');
    }
}
