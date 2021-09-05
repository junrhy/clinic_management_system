<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MessageRoom extends Model
{
     public function messages()
    {
        return $this->hasMany(Message::class, 'room_id')->orderBy('created_at', 'ASC');
    }
}
