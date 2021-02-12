<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ClientBillingPayment extends Model
{
	protected $dates = ['paid_at'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
