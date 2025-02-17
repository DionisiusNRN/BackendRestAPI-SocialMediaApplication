<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\JWTAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\MessagesController;
use PHPUnit\Framework\Attributes\Group;

Route::prefix('v1')->group(function () {

    // Handle auth...
    Route::post('register', [JWTAuthController::class,'register']);
    Route::post('login', [JWTAuthController::class,'login']);

    // menghandle posts
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostsController::class, 'index']); // mengambil semua data.
        Route::post('/', [PostsController::class,'store']); // menyimpan data
        Route::get('{id}', [PostsController::class,'show']); // mengambil detail data by id
        Route::put('{id}', [PostsController::class,'update']); // mengupdate data
        Route::delete('{id}', [PostsController::class,'destroy']); // menghapus data
    });

    // Menghandle comments
    Route::prefix('comments')->group(function () {
        Route::post('/', [CommentsController::class,'store']); // simpan komentar baru
        Route::delete('{id}', [CommentsController::class,'destroy']); // menghapus komentar
    });

    // Menghandle likes
    Route::prefix('likes')->group(function () {
        Route::post('/', [LikesController::class,'store']); // simpan like baru
        Route::delete('{id}', [LikesController::class,'destroy']); // menghapus like
    });

    // Menghandle messages
    Route::prefix('messages')->group(function () {
        Route::post('/', [MessagesController::class,'store']); // Kirim / menyimpan pesan
        Route::get('{id}', [MessagesController::class,'show']); // lihat detail pesan
        Route::get('/getMessages/{user_id}', [MessagesController::class,'getMessages']); // lihat pesan pesan masuk berdasarkan user id
        Route::delete('{id}', [MessagesController::class,'destroy']); // Menghapus pesan
    });

});
