<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\MessageRoom;
use App\Model\Message;
use App\User;

use Auth;

class AdminMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $rooms = MessageRoom::where('is_for_admin', true)->orderBy('created_at', 'DESC')->get();

        return view('admin.message.index')
                    ->with('rooms', $rooms);
    }

    public function create()
    {
        $clients = User::where('is_client', true)->orderBy('name', 'ASC')->get();

        return view('admin.message.create')
                    ->with('clients', $clients);
    }

    public function store(Request $request)
    {
        $request->validate([
            'recipient' => 'required|string',
            'message' => 'required|string',
        ]);

        $member_ids = Auth::user()->id;

        $room = new MessageRoom;
        $room->client_id = 0;
        $room->name = $request->subject;
        $room->member_user_ids = $member_ids;
        $room->read_by_user_ids = Auth::user()->id;
        $room->is_for_admin = true;
        $room->save();

        $message = new Message;
        $message->client_id = 0;
        $message->room_id = $room->id;
        $message->user_id = Auth::user()->id;
        $message->message = $request->message;
        $message->save();

        return redirect('admin/messages');
    }

    public function show_room_conversation(Request $request)
    {
        $room = MessageRoom::find($request->room_id);

        $read_by_user_ids = explode(",", $room->read_by_user_ids);
        
        if (!in_array(Auth::user()->id, $read_by_user_ids))
        {
            array_push($read_by_user_ids, Auth::user()->id);
        }

        $room->read_by_user_ids = implode(",", $read_by_user_ids);
        $room->save();

        $messages = Message::where('room_id', $request->room_id)->orderBy('created_at', 'ASC')->get();

        return view('admin.message._show_conversation')
                    ->with('messages', $messages);
    }

    public function add_reply(Request $request)
    {
        $room = MessageRoom::find($request->room_id);

        $current_member_ids = explode(",", $room->member_user_ids);
        
        if (!in_array(Auth::user()->id, $current_member_ids))
        {
            array_push($current_member_ids, Auth::user()->id);
        }
        
        $room->member_user_ids = implode(",", $current_member_ids);
        $room->read_by_user_ids = Auth::user()->id;
        $room->save();

        $message = new Message;
        $message->client_id = 0;
        $message->room_id = $request->room_id;
        $message->user_id = Auth::user()->id;
        $message->message = $request->message;
        $message->save();

        $messages = Message::where('room_id', $request->room_id)->orderBy('created_at', 'ASC')->get();

        return view('admin.message._show_conversation')
                    ->with('messages', $messages);
    }
}
