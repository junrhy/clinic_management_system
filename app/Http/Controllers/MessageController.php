<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\MessageRoom;
use App\Model\Message;
use App\Model\Patient;
use App\User;

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
        $rooms = MessageRoom::where('client_id', Auth::user()->client_id)->orderBy('created_at', 'DESC')->get();

        return view('message.index')
                    ->with('rooms', $rooms);
    }

    public function create()
    {
        $staffs = User::where('client_id', Auth::user()->client_id)->orderBy('last_name', 'ASC')->get();
        $patients = Patient::where('client_id', Auth::user()->client_id)->orderBy('last_name', 'ASC')->get();

        return view('message.create')
                    ->with('staffs', $staffs)
                    ->with('patients', $patients);
    }

    public function store(Request $request)
    {
        $request->validate([
            'recipient' => 'required|string',
            'message' => 'required|string',
        ]);

        $is_for_admin = false;
        $member_ids = [];

        array_push($member_ids, Auth::user()->id);

        if ( in_array($request->recipient, ["helpcenter"]) ) {
            $is_for_admin = true;
        } 

        if ( !in_array($request->recipient, $member_ids) ) {
            array_push($member_ids, $request->recipient);
        }

        $room = new MessageRoom;
        $room->client_id = Auth::user()->client_id;
        $room->name = $request->subject;
        $room->member_user_ids = implode(",", $member_ids);
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
        $room = MessageRoom::find($request->room_id);

        $read_by_user_ids = explode(",", $room->read_by_user_ids);
        
        if (!in_array(Auth::user()->id, $read_by_user_ids))
        {
            array_push($read_by_user_ids, Auth::user()->id);
        }

        $room->read_by_user_ids = implode(",", $read_by_user_ids);
        $room->save();

        $messages = Message::where('room_id', $request->room_id)->orderBy('created_at', 'ASC')->get();

        return view('message._show_conversation')
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
        $message->client_id = Auth::user()->client_id;
        $message->room_id = $request->room_id;
        $message->user_id = Auth::user()->id;
        $message->message = $request->message;
        $message->save();

        $messages = Message::where('room_id', $request->room_id)->orderBy('created_at', 'ASC')->get();

        return view('message._show_conversation')
                    ->with('messages', $messages);
    }

    public function delete_conversation($room_id)
    {
        $room = MessageRoom::find($room_id);
        $messages = Message::where('room_id', $room->id)->delete();
        $room->delete();
    }
}
