<?php

namespace App\Http\Controllers;

use Faker\Factory;

use App\Post;
use App\Subreddit;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->limit(25)->get();
        $suggestions = Subreddit::inRandomOrder()->limit(5)->get();

        $viewData = [
            'posts' => $posts,
            'suggestions' => $suggestions
        ];

        return view('welcome', $viewData);
    }
}
