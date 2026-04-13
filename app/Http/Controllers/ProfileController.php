<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\IndexRequest;
use App\Http\Requests\Profile\UpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(IndexRequest $request)
    {
        $data = $request->validated();

        $userQuery = User::query()->withStats()
            ->when($data['is_author'] ?? false, fn ($q) => $q->has('posts'))
            ->when($data['search'] ?? null, fn ($q) => $q->where('name', 'like', "%{$data['search']}%"));

        $sortMap = [
            'likes' => 'posts_likes_sum',
            'views' => 'posts_views_sum',
            'posts' => 'posts_count',
            'comments' => 'posts_comments_count',
        ];
        $data['sort_column'] ?? $data['sort_column'] = 'likes';
        $sortColumn = $sortMap[$data['sort_column']];

        $sortDirection = $data['sort_direction'] ?? 'desc';

        $userQuery->orderBy($sortColumn, $sortDirection);

        $users = $userQuery->paginate(20)->withQueryString();


        return view('profile.index')->with(['users' => $users]);
    }

    public function show(User $user)
    {
        $user = User::where('id', $user->id)
            ->withStats()
            ->with([
                'likedPosts' => fn ($q) => $q->withCount('comments')->orderBy('created_at', 'desc'),
                'posts' => fn ($q) => $q->withCount('comments')->orderBy('created_at', 'desc'),
            ])
            ->withCount(['likedPosts', 'posts', 'comments'])
            ->firstOrFail();

        return view('profile.show')->with(['user' => $user]);
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(UpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
