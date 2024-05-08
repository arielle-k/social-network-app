<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use CrudTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id');
    }

    //recuperer le nombre d'amis en commun
    public function friendsInCommon(User $otherUser)
    {
        $userFriends = $this->friends()->pluck('id');
        $otherUserFriends = $otherUser->friends()->pluck('id');

        return $userFriends->intersect($otherUserFriends)->count();
    }

    public function isFriendWith($userId)
{
    return Friendship::where(function ($query) use ($userId) {
        $query->where('user_id', $this->id)
            ->where('friend_id', $userId);
    })->orWhere(function ($query) use ($userId) {
        $query->where('user_id', $userId)
            ->where('friend_id', $this->id);
    })->exists();
}

public function isAdmin()
{
    // Vérifiez si l'utilisateur a un rôle d'administrateur
    return $this->role === 'admin';
}

public function hasProfile()
{
     return $this->profile()->exists();
}


}
