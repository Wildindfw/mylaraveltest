<?php
/**
 * @author Alex Madsen
 *
 * @date November 6, 2018
 */

use Illuminate\Database\Seeder;

class SubredditsTableSeeder extends Seeder
{
    private $subreddits = [
        'birdswitharms',
        'Hearthstone',
        'politics',
        'fedora',
        'i3wm',
        'onguardforthee',
        'nier',
        'XCOM2',
        'metalgear',
        'books',
        'fantasy',
        'lovecraft',
        'BojackHorseman',
        'popular',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->subreddits as $subreddit) {
            factory(App\\Subreddit::)->make([
                'handle' => $subreddit,
            ])->save();
        }
    }
}
