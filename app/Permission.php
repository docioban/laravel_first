<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    public $primaryKey = 'id';

    public function groups()
    {
        return $this->belongsToMany('App\Group', 'groups_permissions', 'permission_id','group_id');
    }
}
