<?php

namespace App;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'last_active_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id', 'username', 'first_name', 'last_name', 'name', 'email', 'password', 'type', 'is_client'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    const DEFAULT_TYPE = 'default';
    const ADMIN_TYPE = 'admin';
    const PATIENT_TYPE = 'patient';
    const DOCTOR_TYPE = 'doctor';
    
    public function isDefault()    {        
        return $this->type === self::DEFAULT_TYPE;    
    }

    public function isUserAdmin()    {        
        return $this->type === self::ADMIN_TYPE;    
    }

    public function isPatient()    {        
        return $this->type === self::PATIENT_TYPE;    
    }

    public function isDoctor()    {        
        return $this->type === self::DOCTOR_TYPE;    
    }

    public function client()
    {
        return $this->belongsTo(\App\Model\Client::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
