<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BillingStatement extends Model
{
	protected $dates = ['billed_at', 'due_at'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
