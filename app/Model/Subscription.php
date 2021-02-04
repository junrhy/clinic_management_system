<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $dates = ['start', 'end'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
