<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
