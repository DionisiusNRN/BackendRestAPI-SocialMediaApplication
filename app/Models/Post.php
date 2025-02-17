<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'content', 'image_url'] ;

    public function user() {
        return $this->belongsTo(User::class); // many-to-one
    }

    public function comments() {
        return $this->hasMany(Comment::class); // one-to-many
    }

    public function likes() {
        return $this->hasMany(Like::class); // one-to-many
    }
}
