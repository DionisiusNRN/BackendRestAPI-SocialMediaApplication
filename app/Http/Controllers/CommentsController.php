<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            "user_id"=> "required",
            "post_id"=> "required",
            "content"=> "required|string|max:255",
        ]);

        // Jika gagal, maka
        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message"=> $validator->errors()->first(),
            ]);
        }

        $comment = Comment::create([
            "user_id"=> $request->user_id,
            "post_id"=> $request->post_id,
            "content"=> $request->content,
        ]);

        return response()->json([
            "success"=> true,
            "message"=> "Berhasil komentar",
            "data" => $comment, // kembalikan data untuk kebutuhan front end
        ], 201);
    }

    public function destroy($id) {
        Comment::destroy($id);

        return response()->json([
            "success"=> true,
            "message"=> "Komentar berhasil dihapus"
        ]);
    }
}
