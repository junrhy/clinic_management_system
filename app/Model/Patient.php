<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['dob','deleted_at'];

    public static function patients($client_id)
    {
        $patients = Patient::where('client_id', $client_id)->get();

        return $patients;
    }
}
