<?php

use App\Http\Controllers\FollowController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [SessionController::class, 'index'])->name('login');

Route::get('/admin', function () {
	return 'Admin';
})->middleware('can:admin');

Route::middleware('guest')->group(function () {
	Route::post('/register', [UserController::class, 'store']);
	Route::post('/login', [SessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
	Route::post('/logout', [SessionController::class, 'destroy']);
	
	Route::redirect('/profile/{user:username}', '/profile/{user:username}/posts');
	Route::get('/profile/{user:username}/posts', [UserController::class, 'showPosts']);
	Route::get('/profile/{user:username}/followers', [UserController::class, 'showFollowers']);
	Route::get('/profile/{user:username}/following', [UserController::class, 'showFollowing']);
	Route::get('/profile/{user:username}/edit', [UserController::class, 'edit'])
			 ->middleware('can:update,user');
	Route::put('/profile/{user:username}', [UserController::class, 'update']);
	
	Route::get('/posts', [PostController::class, 'index']);
	Route::get('/posts/create', [PostController::class, 'create']);
	Route::post('/posts/create', [PostController::class, 'store']);
	Route::get('/posts/{post}', [PostController::class, 'show']);
	Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->middleware('can:update,post');
	Route::put('/posts/{post}', [PostController::class, 'update'])->middleware('can:update,post');
	Route::delete('/posts/{post}', [PostController::class, 'destroy'])->middleware('can:delete,post');
	
	Route::post('/follow/{user:username}', [FollowController::class, 'store']);
	Route::delete('/unfollow/{user:username}', [FollowController::class, 'destroy']);
});
