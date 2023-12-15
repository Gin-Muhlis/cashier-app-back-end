<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleCollection;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller {
	public function index(Request $request): RoleCollection {

		$search = $request->get('search', '');
		$roles = Role::where('name', 'like', "%{$search}%")->paginate();

		return new RoleCollection($roles);
	}

	public function store(Request $request): RoleResource {

		$validated = $this->validate($request, [
			'name' => 'required|unique:roles|max:32',
			'permissions' => 'array',
		]);

		$role = Role::create($validated);

		$permissions = Permission::find($request->permissions);
		$role->syncPermissions($permissions);

		return new RoleResource($role);
	}

	public function show(Role $role): RoleResource {

		return new RoleResource($role);
	}

	public function update(Request $request, Role $role): RoleResource {

		$validated = $this->validate($request, [
			'name' => 'required|max:32|unique:roles,name,' . $role->id,
			'permissions' => 'array',
		]);

		$role->update($validated);

		$permissions = Permission::find($request->permissions);
		$role->syncPermissions($permissions);

		return new RoleResource($role);
	}

	public function destroy(Role $role): Response {

		$role->delete();

		return response()->noContent();
	}
}