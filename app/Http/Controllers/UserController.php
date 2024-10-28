<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
	public function index() {}
	
	public function create(Request $request)
	{
		$data = $request->validate([
				'username' => 'required',
				'email' => 'required|email',
				'password' => 'required',
		]);
		
		User::create($data);
		
		return 'user create';
	}
}
