<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function index() {
        $posts = Post::get(); // mengambil seua data

        return response()->json([
            'success' => true,
            'data'=> $posts
        ]) ;
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'content'=> 'required|string|max:255',
            'image_url'=> 'nullable',
        ]);

        // Jika gagal, maka
        if ($validator->fails()) {
            return response()->json([
                'success'=> false,
                'message'=> $validator->errors(),
            ], 400) ;
        }

        // Jika validasi berhasil, lanjut
        $post = Post::create([
            'user_id'=> $request->user_id,
            'content'=> $request->content,
            'image_url'=> $request->image_url,
        ]);

        return response()->json([
            'success'=> true,
            'message'=> 'Berhasil membuat post baru.',
            'data'=> $post // mengembalikan data untuk keperluan bagian Front-end
        ], 201);
    }

    public function show($id) {
        $post = Post::find($id);

        return response()->json([
            'success'=> true,
            'data'=> $post
        ]);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'content'=> 'required|string|max:255',
            'image_url'=> 'nullable',
        ]);

        // Jika gagal, maka (sama seperti store)
        if ($validator->fails()) {
            return response()->json([
                'success'=> false,
                'message'=> $validator->errors(),
            ], 400) ;
        }

        // buat resource (?) karena pendekatannya adalah objek
        $post = Post::find($id);

        // tampung data baru
        $post->content = $request->content;
        $post->image_url = $request->image_url;

        $post->save(); // menyimpan data

        return response()->json([
            'success'=> true,
            'message'=> 'Berhasil update data',
            'data'=> $post // mengembalikan data untuk keperluan bagian Front-end
        ]);
    }

    public function destroy($id) {
        Post::destroy($id);

        return response()->json([
            'success'=> true,
            'message'=> 'Post berhasil dihapus',
        ]);
    }
}
