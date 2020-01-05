<?php
/**
 * @author Alex Madsen
 *
 * @date November 6, 2018
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'user_profiles';

    protected $primaryKey = 'id_users';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
