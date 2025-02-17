<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;




class LikesController extends Controller
{
    public function store(Request $request) {
        $user = JWTAuth::parseToken()->authenticate();

        $validator = Validator::make($request->all(), [
            "post_id"=> "required",
        ]);

        // jika gagal maka
        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message"=> $validator->errors()->first(),
            ]);
        }

        $like = Like::create([
            "user_id"=> $user->id, // pakai variabel user
            "post_id"=> $request->post_id,
        ]);

        // jika berhasil, maka
        return response()->json([
            "success"=> true,
            "message"=> "Berhasil Like",
            "data"=> $like,
        ], 201);
    }

    public function destroy($id) {
        Like::destroy($id);

        return response()->json([
            "success"=> true,
            "message"=> "Like berhasil dihapus"
        ]);
    }
}
