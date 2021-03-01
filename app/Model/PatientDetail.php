<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PatientDetail extends Model
{
	protected $dates = ['date_scheduled'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function clinic_model()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id', 'id');
    }

    public function doctor_model()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }

    public function attachment()
    {
    	return $this->hasMany('App\Model\Attachment','attachment_number','attachment_number');
    }
}
