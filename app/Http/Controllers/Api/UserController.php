<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
	public function index(Request $request): UserCollection {

		$users = User::all();

		return new UserCollection($users);
	}

	public function store(UserStoreRequest $request) {

		$validated = $request->validated();

		$validated['password'] = Hash::make($validated['password']);

		$user = User::create($validated);

		return response()->json([
			'success' => true,
			'message' => 'User berhasil ditambahkan',
		]);
	}

	public function show(Request $request, User $user): UserResource {

		return new UserResource($user);
	}

	public function update(UserUpdateRequest $request, User $user) {

		$validated = $request->validated();

		if (empty($validated['password'])) {
			unset($validated['password']);
		} else {
			$validated['password'] = Hash::make($validated['password']);
		}

		$user->update($validated);

		return response()->json([
			'success' => true,
			'message' => 'User berhasil diupdate',
		]);
	}

	public function destroy(Request $request, User $user) {

		$user->delete();

		return response()->json([
			'success' => true,
			'message' => 'User berhasil dihapus',
		]);
	}
}
