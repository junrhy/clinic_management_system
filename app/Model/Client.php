<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Client extends Model
{
	public function clinics()
    {
        return $this->hasMany(Clinic::class);
    }

	public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'client_id');
    }
}
