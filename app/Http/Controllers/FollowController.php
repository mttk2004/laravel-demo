<?php

namespace App\Http\Controllers;


use App\Models\Follow;
use App\Models\User;


class FollowController extends Controller
{
	public function store(User $user)
	{
		// cannot follow yourself
		if ($user->id === auth()->id()) {
			return back()->with('error', 'You cannot follow yourself.');
		}
		
		// cannot follow the same user twice
		if ($user->followers->contains(fn($follower) => $follower->user_id === auth()->user()->id)) {
			return back()->with('error', 'You are already following this user.');
		}
		
		// follow the user
		$follow = Follow::create([
				'user_id' => auth()->id(),
				'followed_user_id' => $user->id,
		]);
		
		if (!$follow) {
			return back()->with('error', 'An error occurred while following ' . $user->username . '.');
		}
		
		return back()->with('success', 'You are now following ' . $user->username . '.');
	}
	
	public function destroy(User $user)
	{
		// cannot unfollow yourself
		if ($user->id === auth()->id()) {
			return back()->with('error', 'You cannot unfollow yourself.');
		}
		
		// cannot unfollow a user you are not following
		$follow = Follow::where('user_id', auth()->id())
										->where('followed_user_id', $user->id)
										->first();
		if (!$follow) {
			return back()->with('error', 'You are not following ' . $user->username . '.');
		}
		
		// unfollow the user
		$follow->delete();
		
		return back()->with('success', 'You have unfollowed ' . $user->username . '.');
	}
}
