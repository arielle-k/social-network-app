<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $fillable = [
        'name',
        'content',
        'image',
        'user_id'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function likes()
    {
        //return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id');
        return $this->hasMany(Like::class);
    }
    public function isLikedByLoggedInUser()
    {

        return $this->likes()->where('user_id', auth()->user()->id)->exists();

    }


    public function isLikedBy($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


}
