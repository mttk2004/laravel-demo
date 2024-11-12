<?php

namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PostController extends Controller
{
	public function index()
	{
		$posts = Post::orderBy('created_at', 'desc')->paginate(5);
		
		return view('posts.index', compact('posts'));
	}
	
	public function create()
	{
		return view('posts.create');
	}
	
	public function store(Request $request)
	{
		$data = $request->validate([
				'title' => ['required'],
				'body' => ['required'],
		]);
		
		$data['title'] = strip_tags($data['title']);
		$data['body'] = nl2br(strip_tags($data['body']));
		$data['user_id'] = auth()->id();
		
		$post = Post::create($data);
		if ($post) {
			return redirect("/posts/$post->id")->with('success', 'Post created successfully.');
		}
		
		return back()->with('error', 'Post could not be created.');
	}
	
	public function show(Post $post)
	{
		$post->body = strip_tags(Str::markdown($post->body),
				'<br><p><a><strong><em><ul><ol><li><h1><h2><h3><h4><h5><h6>');
		
		return view('posts.show', compact('post'));
	}
	
	public function edit(Post $post)
	{
		return view('posts.edit', compact('post'));
	}
	
	public function update(Request $request, Post $post)
	{
		$data = $request->validate([
				'title' => ['required'],
				'body' => ['required'],
		]);
		
		$data['title'] = strip_tags($data['title']);
		$data['body'] = strip_tags(nl2br(($data['body'])));
		
		$updatedPost = $post->update($data);
		
		if (!$updatedPost) {
			return back()->with('error', 'Post could not be updated.');
		}
		
		return redirect("/posts/$post->id")->with('success', 'Post updated successfully.');
	}
	
	public function destroy(Post $post)
	{
		if (auth()->user()->cannot('delete', $post)) {
			return back()->with('error', 'You are not authorized to delete this post.');
		}
		$post->delete();
		
		return redirect('/profile/' . auth()->user()->username)->with('success',
				'Post deleted successfully.');
	}
}
