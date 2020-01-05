<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{

    protected $table = 'medias';

    protected $fillable = ['id_users', 'id_posts', 'type', 'file'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
