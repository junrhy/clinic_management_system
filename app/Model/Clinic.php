<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Model\PatientDetail;

class Clinic extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public static function clinics($client_id)
    {
        $clinics = Clinic::where('client_id', $client_id)->pluck('name', 'id');

        return $clinics;
    }

    public function appointments($client_id, $date, $clinic_id)
    {
    	$appointments = PatientDetail::where('client_id', $client_id)
                            ->whereDate('date_scheduled', $date)
    						->whereIn('status', ['Open', 'In Progress'])
    						->where('clinic_id', $clinic_id)
    						->orderBy('time_scheduled', 'asc')
    						->get();

        return $appointments;
    }
}
