<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;

class Doctor extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public static function doctors($client_id)
    {
        $doctors = Doctor::where('client_id', $client_id)->pluck('name', 'id');

        return $doctors;
    }
}
