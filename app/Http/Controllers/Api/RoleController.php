<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleCollection;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller {
	public function index(Request $request) {

		$roles = Role::latest()->get();

		$data = new RoleCollection($roles);

		return response()->json([
			'success' => true,
			'data' => $data,
		]);
	}

	public function store(Request $request) {

		$validated = $this->validate($request, [
			'name' => 'required|unique:roles|max:32',
		]);

		$role = Role::create($validated);

		return response()->json([
			'success' => true,
			'message' => 'Role berhasil ditambahkan',
		]);
	}

	public function show(Role $role): RoleResource {

		return new RoleResource($role);
	}

	public function update(Request $request, Role $role) {

		$validated = $this->validate($request, [
			'name' => 'required|max:32|unique:roles,name,' . $role->id,
		]);

		$updatedRole = $role->update($validated);

		return response()->json([
			'success' => true,
			'message' => 'Role berhasil diupdate',
			'data' => $updatedRole,
		]);
	}

	public function destroy(Role $role) {

		$role->delete();

		return response()->json([
			'success' => true,
			'message' => 'Role berhasil dihapus',
		]);
	}
}