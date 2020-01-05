<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{

    protected $fillable = ['description'];



    public function medias()
    {
        return $this->hasMany(Media::class, 'id_posts');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'id_posts');
    }

    public function feeds(User $user)
    {
        if (empty($user))

        return $this->belongsTo(Feeds::class, 'subreddit_id');

    }

    public function subreddit()
    {
        return $this->belongsTo(Subreddit::class, 'subreddit_id');
    }

    public function upVotes()
    {
        return $this->belongsToMany(User::class, 'up_votes');
    }

    public function downVotes()
    {
        return $this->belongsToMany(User::class, 'down_votes');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }


     $userPosts = $user
            ->select('posts.*')
            ->leftJoin('follows', 'users.id', '=', 'follows.id_users')
            ->join('posts', function ($join) {
                $join
                    ->on('posts.id_users', '=', 'users.id')
                    ->orOn('posts.id_users', '=', 'follows.id_following');
            })
            ->where('users.id', $user->id)
            ->groupBy('posts.id')
            ->orderBy('posts.created_at', 'desc')
            ->paginate();

        $userPosts->each(function ($userPost, $key) {
            $userPost->likes = $userPost->likes()->count();
            $userPost->medias = Post::find($userPost->id)
                ->medias()->get();
            return $userPost;
        });

        return $userPosts;
    }
}
