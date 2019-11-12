<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PatientDetail extends Model
{
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function attachment()
    {
    	return $this->hasMany('App\Model\Attachment','attachment_number','attachment_number');
    }
}
