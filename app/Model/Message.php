<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function sender()
    {
        return $this->belongsTo(\App\User::class, 'sender_user_id', 'id');
    }

    public function recipient()
    {
        return $this->belongsTo(\App\User::class, 'recipient_user_id', 'id');
    }
}
