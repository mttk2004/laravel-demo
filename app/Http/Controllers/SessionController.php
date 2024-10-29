<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;


class SessionController extends Controller
{
	public function index()
	{
		return view(auth()->check() ? 'homepage-user' : 'homepage-guest');
	}
	
	public function store(Request $request)
	{
		$data = $request->validate([
				'login_username' => ['required'],
				'login_password' => ['required'],
		]);
		
		if (auth()->attempt([
				'username' => $data['login_username'],
				'password' =>
						$data['login_password'],
		])) {
			$request->session()->regenerate();
			
			return redirect('/')->with('success', 'You have been logged in.');
		} else {
			return back()->withErrors([
					'login_username' => 'The provided credentials do not match our records.',
			]);
		}
	}
	
	public function destroy()
	{
		auth()->logout();
		return redirect('/')->with('success', 'You have been logged out.');
	}
}
