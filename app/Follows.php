<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follows extends Model
{
    // public $table = 'follows';
    protected $fillable = ['id_following', 'id_users'];
    protected $hidden = ['id'];
}
