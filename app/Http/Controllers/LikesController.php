<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Validator;



class LikesController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            "user_id"=> "required",
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
            "user_id"=> $request->user_id,
            "post_id"=> $request->post_id,
        ]);

        // jika berhasil, maka
        return response()->json([
            "success"=> true,
            "message"=> "Berhasil Like",
            "data"=> $like,
        ], 201);
}
