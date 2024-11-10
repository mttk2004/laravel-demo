<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;


class UserController extends Controller
{
	public function showPosts(User $user)
	{
		return view('user.posts', [
				'user' => $user,
				'posts' => $user->posts()->get(),
				'avatar' => $user->avatar,
				'numPosts' => $user->posts()->count(),
				'numFollowers' => $user->followers()->count(),
				'numFollowings' => $user->following()->count(),
		]);
	}
	
	public function showFollowers(User $user)
	{
		$followers = $user->followers()->with('follower')->get();
		
		return view('user.followers', [
				'user' => $user,
				'followers' => $followers,
				'numPosts' => $user->posts()->count(),
				'numFollowers' => $user->followers()->count(),
				'numFollowings' => $user->following()->count(),
		]);
	}
	
	public function showFollowing(User $user)
	{
		$following = $user->following()->with('followedUser')->get();
		
		return view('user.following', [
				'user' => $user,
				'following' => $following,
				'numPosts' => $user->posts()->count(),
				'numFollowers' => $user->followers()->count(),
				'numFollowings' => $user->following()->count(),
		]);
	}
	
	public function store(Request $request)
	{
		$data = $request->validate([
				'username' => ['required', 'min:6', 'max:12', Rule::unique('users', 'username')],
				'email' => ['required', 'email', Rule::unique('users', 'email')],
				'password' => ['required', 'min:6', 'max:12', 'confirmed'],
		]);
		
		$data['password'] = bcrypt($data['password']);
		$user = User::create($data);
		
		auth()->login($user);
		
		return redirect('/')->with('success', 'You have been registered and logged in.');
	}
	
	public function edit(User $user)
	{
		return view('user.edit', compact('user'));
	}
	
	public function update(Request $request)
	{
		// Policy check
		$this->authorize('update', $request->user());
		
		$request->validate([
				'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|:2048',
		]);
		
		// Save the new avatar
		$imageData = Image::make($request->file('avatar'))
											->encode('webp')->fit(128);
		$fileName = "{$request->user()->id}-" . uniqid() . '.webp';
		Storage::put('public/avatars/' . $fileName, $imageData);
		
		// Update the user's avatar in the database and delete the old one
		$oldAvatar = $request->user()->getRawOriginal('avatar');
		$request->user()->avatar = $fileName;
		$request->user()->save();
		
		// If the user's avatar is the default one, don't delete it
		if ($oldAvatar !== 'https://i.pravatar.cc/150?u=a042581f4e29026704e') {
			Storage::delete('public/avatars/' . $oldAvatar);
		}
		
		return redirect()->back()->with('success', 'Your avatar has been updated.');
	}
}



















