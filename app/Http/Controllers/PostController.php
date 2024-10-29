<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;


class PostController extends Controller
{
	public function index() {}
	
	public function create()
	{
		return view('post.create');
	}
	
	public function store(Request $request)
	{
		$data = $request->validate([
				'post-title' => ['required'],
				'post-body' => ['required']
		]);
		
		
	}
}
