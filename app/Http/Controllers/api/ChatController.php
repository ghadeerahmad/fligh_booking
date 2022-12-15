<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function sendMessage(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|max:255',

        ]);
        if ($validator->fails()) return response(['status' => 0, 'message' => $validator->errors()->first()], 200);
        $data = [
            'message' => $request->input('message'),
            'user_id' => auth()->user()->id,
            'chat_id' => $id
        ];
        $message = Message::create($data);
        if ($message != null) return response(['status' => 1, 'message' => 'sent'], 200);
        return response(['status' => 0, 'message' => 'error'], 200);
    }
    public function getMessages()
    {
        $chat = Chat::where('sender_id', auth()->user()->id)->first();
        $messages = array();
        if ($chat == null)
            $chat = Chat::create(['sender_id'=>auth()->user()->id, 'rec_id' => 1]);
        $messages = Message::where('chat_id', $chat->id)
            ->get();
        return response(['status' => 1, 'data' => $messages,'chat'=>$chat], 200);
    }
}
