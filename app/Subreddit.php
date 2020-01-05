<?php
/**
 * @author Alex Madsen
 *
 * @date November 6, 2018
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subreddit extends Model
{
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
