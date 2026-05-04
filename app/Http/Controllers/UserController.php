<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\IndexRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(IndexRequest $request)
    {
        $users = User::query()
            ->stats()
            ->filter($request->validated())
            ->sort($request->validated())
            ->paginate(20)
            ->withQueryString();

        return view('users.index', compact('users'));
    }


    public function show(User $user)
    {
        $user->loadCount(['posts', 'postsComments', 'postsLikes', 'comments', 'likes','followings', 'followers'])
        ->loadSum('posts','views');

        return view('users.show')->with(['user' => $user,]);
    }
    /**
     * Display the user's users form.
     */
    public function edit(Request $request): View
    {
        return view('users.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's users information.
     */
    public function update(UpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('users.edit', ['user' => $request->user])->with('status', 'users-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
