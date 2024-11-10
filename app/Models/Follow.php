<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Follow extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable
			= [
					'user_id',
					'followed_user_id',
			];
	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts
			= [
					'user_id' => 'int',
					'followed_user_id' => 'int',
			];
	
	/**
	 * Get the user that owns the follow.
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
	
	/**
	 * Get the user that is followed.
	 */
	public function followedUser(): BelongsTo
	{
		return $this->belongsTo(User::class, 'followed_user_id');
	}
	
	/**
	 * Determine if the authenticated user is following the given user.
	 *
	 * @param User $user
	 *
	 * @return bool
	 */
	public static function isFollowing(User $user): bool
	{
		return Follow::where('user_id', auth()->id())
								 ->where('followed_user_id', $user->id)
								 ->exists();
	}
	
	public function follower()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}
