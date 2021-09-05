<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\MessageRoom;
use App\Model\Message;
use App\Model\Patient;

use Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_default');
    }

    public function index()
    {
        $rooms = MessageRoom::where('client_id', Auth::user()->client_id)->orderBy('created_at', 'ASC')->get();

        return view('message.index')
                    ->with('rooms', $rooms);
    }

    public function create()
    {
        $patients = Patient::where('client_id', Auth::user()->client_id)->orderBy('last_name', 'ASC')->get();

        return view('message.create')
                    ->with('patients', $patients);
    }

    public function store(Request $request)
    {
        $request->validate([
            'recipient' => 'required|string',
            'message' => 'required|string',
        ]);

        $is_for_admin = false;
        $member_ids = Auth::user()->id;

        if ( in_array($request->recipient, ["helpcenter"]) ) {
            $is_for_admin = true;
        } 

        if ( !in_array($request->recipient, ["helpcenter"]) ) {
            $member_ids = $request->recipient;
        }

        $room = new MessageRoom;
        $room->client_id = Auth::user()->client_id;
        $room->name = $request->subject;
        $room->member_user_ids = $member_ids;
        $room->read_by_user_ids = Auth::user()->id;
        $room->is_for_admin = $is_for_admin;
        $room->save();

        $message = new Message;
        $message->client_id = Auth::user()->client_id;
        $message->room_id = $room->id;
        $message->user_id = Auth::user()->id;
        $message->message = $request->message;
        $message->save();

        return redirect('message');
    }

    public function show_room_conversation(Request $request)
    {
        $messages = Message::where('room_id', $request->room_id)->orderBy('created_at', 'ASC')->get();

        return view('message._show_conversation')
                    ->with('messages', $messages);
    }

    public function add_reply(Request $request)
    {
        $message = new Message;
        $message->client_id = Auth::user()->client_id;
        $message->room_id = $request->room_id;
        $message->user_id = Auth::user()->id;
        $message->message = $request->message;
        $message->save();

        $messages = Message::where('room_id', $request->room_id)->orderBy('created_at', 'ASC')->get();

        return view('message._show_conversation')
                    ->with('messages', $messages);
    }
}
