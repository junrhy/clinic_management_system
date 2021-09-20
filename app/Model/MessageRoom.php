<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MessageRoom extends Model
{
     public function messages()
    {
        return $this->hasMany(Message::class, 'room_id')->orderBy('created_at', 'ASC');
    }

    public static function user_unread_messages($client_id, $user_id)
    {
        $rooms = MessageRoom::where('client_id', $client_id)->get();
        
        $unread = 0;
        foreach ($rooms as $room) {
            $member_ids = explode(',', $room->member_user_ids);

            if (in_array($user_id, $member_ids)) {
                $read_by_user_ids = explode(',', $room->read_by_user_ids);

                if ( !in_array($user_id, $read_by_user_ids) ) {
                    $unread++;
                }
            }
        }

        return $unread;
    }
}
