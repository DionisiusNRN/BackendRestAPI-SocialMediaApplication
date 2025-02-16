<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use PHPUnit\Framework\Attributes\Group;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
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
});
