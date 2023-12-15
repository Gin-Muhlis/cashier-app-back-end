<?php

namespace App\Policies;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy {
	use HandlesAuthorization;

	/**
	 * Determine whether the menu can view any models.
	 */
	public function viewAny(User $user): bool {
		return $user->hasPermissionTo('list menus');
	}

	/**
	 * Determine whether the menu can view the model.
	 */
	public function view(User $user, Menu $model): bool {
		return $user->hasPermissionTo('view menus');
	}

	/**
	 * Determine whether the menu can create models.
	 */
	public function create(User $user): bool {
		return $user->hasPermissionTo('create menus');
	}

	/**
	 * Determine whether the menu can update the model.
	 */
	public function update(User $user, Menu $model): bool {
		return $user->hasPermissionTo('update menus');
	}

	/**
	 * Determine whether the menu can delete the model.
	 */
	public function delete(User $user, Menu $model): bool {
		return $user->hasPermissionTo('delete menus');
	}

	/**
	 * Determine whether the user can delete multiple instances of the model.
	 */
	public function deleteAny(User $user): bool {
		return true;
	}

	/**
	 * Determine whether the menu can restore the model.
	 */
	public function restore(User $user, Menu $model): bool {
		return false;
	}

	/**
	 * Determine whether the menu can permanently delete the model.
	 */
	public function forceDelete(User $user, Menu $model): bool {
		return false;
	}
}
