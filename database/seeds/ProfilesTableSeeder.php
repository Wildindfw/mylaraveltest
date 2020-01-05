<?php
/**
 * @author Alex Madsen
 *
 * @date November 6, 2018
 */

use Illuminate\Database\Seeder;

use App\Subreddit;
use App\Profile;
use App\User;



class ProfilesTableSeeder extends Seeder
{
    /**
     * NOTE: Known this is a bad code smell... Maybe this is the least evil to seed
     * unique user handles?
     */
    public static $names = [
        'JaneDoe',
        'JohnDoe',
        'KarlMarx',
        'KarlPopper',
        'ThatDudeCameron',
        'SomeGuyNamedAlex',
        'esdeseseserd',
        'plurmpmcGurten',
        'W3r4lln00bz'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::all()->each(function($user) {
            factory'App\Profile'::class->make([
                'id_users' => $user->id,
                'handle' => ProfilesTableSeeder::$names[$user->id - 1],
            ])->save();
        });
    }
}
