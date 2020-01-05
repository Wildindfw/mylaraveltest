<?php

namespace App\Http\Controllers;

use App\Follows;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{

    public function followers($idUser)
    {
        $user = User::find($idUser);
        return $user
            ->followers()
            ->count();
    }

    public function followersUsers($idUser)
    {
        $user = User::find($idUser);
        return $user
            ->followers()
            ->orderBy('created_at', 'desc')
            ->paginate();
    }

    public function followings($idUser)
    {
        $user = User::find($idUser);
        return $user
            ->followings()
            ->count();
    }

    public function followingsUsers($idUser)
    {
        $user = User::find($idUser);
        return $user
            ->followings()
            ->orderBy('created_at', 'desc')
            ->paginate();
    }

    public function save(Request $request, $idUser)
    {
        $userFollowing = User::find($idUser);

        if (empty($userFollowing))
            return response()->json(['message' => 'User not found'], 400);

        $user = Auth::user();

        if ($idUser == $user->id)
            return response()->json(['message' => 'You can\'t follow yoursel'], 400);

        $data = [
            'id_following' => $userFollowing->id,
            'id_users' => $user->id
        ];

        $folllow = Follows::where($data)->first();

        if (empty($folllow)) {
            return Follows::create($data);
        } else {
            $folllow->delete();
            return response()->json([], 204);
        }
    }
}
