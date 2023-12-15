<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 */
	public function run(): void {
		$role = Role::whereName('admin')->first();
		User::factory()->create([
			'name' => 'Fubuki Shirakami',
			'address' => 'Tokyo, Jepang',
			'email' => 'admin@admin.com',
			'phone' => '0895616007300',
			'password' => Hash::make('admin'),
			'role_id' => $role->id,
		]);}
}
