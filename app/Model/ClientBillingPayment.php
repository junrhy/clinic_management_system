<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ClientBillingPayment extends Model
{
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
