<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Post;
use App\Profile;

class ProfileController extends Controller
{
    public function index($handle)
    {
        // We can grab the first handle element, because we know
        $user = Profile::where('handle', $handle)->firstOrFail()->user;
        $posts = Post::where('id_users', $user->id)->orderBy('created_at', 'desc')->get();

        $viewData = [
            'user' => $user,
            'id_posts' => $posts,
        ];

        return view('user-profile', $viewData);
    }

    public function edit()
    {
        if(!(request()->user())) {
            return redirect('/register');
        }

        $viewData = [
            'user' => request()->user(),
        ];

        return view('edit-profile', $viewData);
    }

    public function update()
    {
        $user = request()->user();
        $formData = request()->all();

        $validationList = [
            'name' => "required|regex:/^[a-z ,.'-]+$/i",
            'icon' => 'nullable|url',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            'description' => 'nullable|max:255',
        ];

        // Don't validate the handle if it hasn't changed.
        // Validating if it hasn't changed results in a false-positive
        if($user->profile->handle !== $formData['handle']) {
            $validationList['handle'] = 'required|unique:user_profiles';
        }

        request()->validate($validationList);

        $profile = $user->profile;

        $user->name = $formData['name'];
        $user->save();

        $profile->handle = $formData['handle'];
        $profile->icon = $formData['icon'];
        $profile->photo = $formData['photo'];
        $profile->description = $formData['description'];
        $profile->save();

        return redirect("/u/{$user->profile->handle}");
    }
}
