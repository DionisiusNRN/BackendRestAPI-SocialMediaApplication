<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Validator;

class MessagesController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'sender_id' => 'required',
            'receiver_id'=> 'required',
            'message_content'=> 'required|string|max:255',
        ]);

        // Jika gagal, maka
        if ($validator->fails()) {
            return response()->json([
                'success'=> false,
                'message'=> $validator->errors(),
            ], 400) ;
        }

        // Lanjut jika validasi OK
        $message = Message::create([
            'sender_id' => $request->sender_id,
            'receiver_id'=> $request->receiver_id,
            'message_content'=> $request->message_content,
        ]);

        return response()->json([
            'success'=> true,
            'message'=> 'Berhasil mengirim pesan',
            'data'=> $message,
        ]);
    }

    public function show($id) {
        $message = Message::find($id);

        return response()->json([
            'success'=> true,
            'message'=> 'Berhasil mengambil pesan',
            'data'=> $message
        ]);
    }

    public function getMessages($user_id) {
        $messages = Message::where('receiver_id',$user_id)->get();

        return response()->json([
            'success'=> true,
            'message'=> 'Berhasil mengambil pesan-pesan berdasarkan user',
            'data'=> $messages
        ]);
    }

    public function destroy($id) {
        Message::destroy($id);

        return response()->json([
            'success'=> true,
            'message'=> 'Pesan berhasil dihapus'
        ]);
    }
}
