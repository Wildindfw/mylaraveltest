<?php
/**
 * @author Alex Madsen
 * 
 * @date November 6, 2018
 */

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\User', count(ProfilesTableSeeder::$names))->create(); 
    }
}
