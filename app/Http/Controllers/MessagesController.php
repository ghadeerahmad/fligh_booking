<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller
{
    public function index()
    {
        $chats = DB::table('messages')
            ->join('users', 'messages.user_id', '=', 'users.id')
            ->where('messages.reciever', auth()->user()->id)
            ->select('messages.user_id', 'users.name', 'messages.message', 'users.image', 'messages.created_at')
            ->orderBy('messages.created_at', 'DESC')
            ->groupBy('messages.user_id', 'users.name', 'messages.message', 'users.image', 'messages.created_at')
            ->distinct()
            ->paginate(20);
        return view('control.chats', ['chats' => $chats]);
    }
    public function chat()
    {
        $user = auth()->user();
        $chats = Chat::with(['messages','sender'])->where('rec_id',$user->id)->orWhere('sender_id',auth()->user()->id)->get();
        //dd($chs);
        return view('control.chat', ['chats' => $chats,]);
    }
    public function getChat($id)
    {
        $chat = Chat::find($id);
        $messages = Message::where('chat_id',$id)->get();
        return view('control.messages', ['chat'=>$chat, 'messages' => $messages]);
    }
    public function sendMessage(Request $request,$id)
    {
        $request->validate([
            'message' => 'required|max:255',
        ]);
        $data = [
            'message' => $request->input('message'),
            'user_id' => auth()->user()->id,
            'chat_id'=>$id
        ];
        $message = Message::create($data);
        if ($message != null)
            return response()->json(['success' => 'success', 'message' => $message->message]);
        return response()->json(['errors' => 'error']);
    }
    public function openChat($id)
    {
        $chat = Chat::where('sender_id',$id)->orWhere('rec_id',$id)->first();
        if($chat == null)
            $chat = Chat::create(['rec_id'=>auth()->user()->id,'sender_id'=>$id]);

        $chats = Chat::with(['messages','sender'])->where('rec_id',auth()->user()->id)->get();
        return view('control.chat', ['chats' => $chats, 'chat_id' => $chat->id]);
    }
}
