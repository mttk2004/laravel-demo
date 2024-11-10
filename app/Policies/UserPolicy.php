<?php

namespace App\Policies;


use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class UserPolicy
{
	use HandlesAuthorization;
	
	public function update(User $user, User $model): bool {
		\Log::info('UserPolicy@update called', ['user_id' => $user->id, 'model_id' => $model->id, 'result' => $user->id === $model->id]);
		
		return $user->id === $model->id;
	}
	
	public function delete(User $user, User $model): bool {
		return $user->is_admin || $user->id === $model->id;
	}
	
//	public function restore(User $user, User $model): bool {}

//	public function forceDelete(User $user, User $model): bool {}
}
