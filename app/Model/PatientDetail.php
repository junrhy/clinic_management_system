<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PatientDetail extends Model
{
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
