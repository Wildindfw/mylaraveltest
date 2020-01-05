<?php

namespace App\Http\Controllers;

use App\Services\Upload\UploadUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{

    public function create(Request $request, UploadUser $uploadUser)
    {
        if ($erros = $this->validator($request))
            return $erros;

        $data = $request->only([
            'name', 'email', 'password', 'location'
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['photo'] = $uploadUser->upload($request);
        if ($data['photo'])
            $uploadUser->resize($data['photo']);

        Auth::logout();
        $user = User::create($data);
        $user->url_photo = $uploadUser->getUrl();
        return $user;
    }

    public function update(Request $request, UploadUser $uploadUser)
    {

        if ($erros = $this->validator($request))
            return $erros;

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->location = $request->location;
        $photo = $uploadUser->upload($request);

        if ($photo) {
            $uploadUser->resize($photo);
            $user->photo = $photo;
        }

        $user->save();

        $user->url_photo = $uploadUser->getUrl() . '/' . $user->photo;
        return $user;
    }

    private function validator(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8:255|confirmed',
            'password_confirmation' => 'required',
            'location' => 'required|string|max:255',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        if (Auth::check()) {
            $rules['email'] = [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore(Auth::user()->id),
            ];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Form is not valid',
                'erros' => $validator->errors()->all()
            ], 400);
        }

        return null;
    }
}
