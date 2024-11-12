<?php

namespace App\Models;


// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable;
	
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable
			= [
					'username',
					'email',
					'password',
			];
	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden
			= [
					'password',
					'remember_token',
			];
	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts
			= [
					'email_verified_at' => 'datetime',
			];
	
	protected function avatar(): Attribute
	{
		return Attribute::make(get: function ($value) {
			return $value ? asset('storage/avatars/' . $value) :
					'https://i.pravatar.cc/150?u=a042581f4e29026704e';
		});
	}
	
	public function posts(): HasMany
	{
		return $this->hasMany(Post::class);
	}
	
	public function followers(): HasMany
	{
		return $this->hasMany(Follow::class, 'followed_user_id');
	}
	
	public function following(): HasMany
	{
		return $this->hasMany(Follow::class, 'user_id');
	}
	
	public function feedPosts()
	{
		return $this->hasManyThrough(Post::class, Follow::class, 'user_id', 'user_id', 'id',
				'followed_user_id');
	}
}
