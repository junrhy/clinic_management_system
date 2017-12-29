<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
