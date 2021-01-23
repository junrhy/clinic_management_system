<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    protected $dates = ['dob','deleted_at'];

    public static function patients($client_id)
    {
        $patients = Patient::where('client_id', $client_id)->get();

        return $patients;
    }

    public function charges()
    {
        return $this->hasMany(PatientBillingCharge::class, 'patient_id');
    }

    public function payments()
    {
        return $this->hasMany(PatientBillingPayment::class, 'patient_id');
    }
}
