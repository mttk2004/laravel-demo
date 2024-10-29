<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
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
}
