<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clinic extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public static function clinics($client_id)
    {
        $clinics = Clinic::where('client_id', $client_id)->pluck('name', 'id');

        return $clinics;
    }
}
