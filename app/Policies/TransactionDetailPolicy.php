<?php

namespace App\Policies;

use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionDetailPolicy {
	use HandlesAuthorization;

	/**
	 * Determine whether the transactionDetail can view any models.
	 */
	public function viewAny(User $user): bool {
		return $user->hasPermissionTo('list transactiondetails');
	}

	/**
	 * Determine whether the transactionDetail can view the model.
	 */
	public function view(User $user, TransactionDetail $model): bool {
		return $user->hasPermissionTo('view transactiondetails');
	}

	/**
	 * Determine whether the transactionDetail can create models.
	 */
	public function create(User $user): bool {
		return $user->hasPermissionTo('create transactiondetails');
	}

	/**
	 * Determine whether the transactionDetail can update the model.
	 */
	public function update(User $user, TransactionDetail $model): bool {
		return $user->hasPermissionTo('update transactiondetails');
	}

	/**
	 * Determine whether the transactionDetail can delete the model.
	 */
	public function delete(User $user, TransactionDetail $model): bool {
		return $user->hasPermissionTo('delete transactiondetails');
	}

	/**
	 * Determine whether the user can delete multiple instances of the model.
	 */
	public function deleteAny(User $user): bool {
		return true;
	}

	/**
	 * Determine whether the transactionDetail can restore the model.
	 */
	public function restore(User $user, TransactionDetail $model): bool {
		return false;
	}

	/**
	 * Determine whether the transactionDetail can permanently delete the model.
	 */
	public function forceDelete(User $user, TransactionDetail $model): bool {
		return false;
	}
}
