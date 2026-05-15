<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        $followers = $user->followings()->stats()->get();
        return view('followers.index')->with('users', $followers);
    }

    public function follow($following)
    {
        /** @var User $user */
        $user = Auth::user();
        Follower::create([
            'follower_id' => $user->id,
            'following_id' => $following
        ]);

        return redirect()->back();
    }

    public function unfollow($following)
    {
        /** @var User $user */
        $user = Auth::user();

        $follow = Follower::where(['follower_id' => $user->id, 'following_id' => $following],[]);

        $follow->delete();

        return redirect()->back();
    }
}
