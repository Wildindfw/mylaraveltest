<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'location', 'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'id_users');
    }
    public function upVotes()
    {
        return $this->belongsToMany(Post::class, 'id_users');
    }
    public function downVotes()
    {
        return $this->belongsToMany(Post::class, 'id_users');
    }
    public function profile()
    {

        return $this->hasOne(Profile::class, 'id_users');
    }
    public function followers()
    {
        return $this->hasMany(Follow::class, 'id_following');
    }

    public function followings()
    {
        return $this->hasMany(Follow::class, 'id_users');
    }

    public function medias()
    {
        return $this->hasMany(Follow::class, 'id_users');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'id_users');
    }

    public function sessions()
    {
        return $this->hasMany(Session::class, 'id_users');
    }


}

}
