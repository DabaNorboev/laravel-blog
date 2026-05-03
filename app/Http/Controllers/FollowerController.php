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
        $followers = $user->followings()->withStats()->get();
        return view('followers.index')->with('users', $followers);
    }

    public function follow($following)
    {
        /** @var User $user */
        $user = Auth::user();
        $user->followings()->attach($following);

        return redirect()->back();
    }

    public function unfollow($following)
    {
        /** @var User $user */
        $user = Auth::user();
        $user->followings()->detach($following);

        return redirect()->back();
    }
}
