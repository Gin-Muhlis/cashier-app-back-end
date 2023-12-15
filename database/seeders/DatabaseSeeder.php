<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
	/**
	 * Seed the application's database.
	 */
	public function run(): void {
		// \App\Models\User::factory(10)->create();

		\App\Models\User::factory()->create([
			'name' => 'Fubuki Shirakami',
			'address' => 'Tokyo, Jepang',
			'email' => 'admin@admin.com',
			'phone' => '0895616007300',
			'password' => Hash::make('admin'),
		]);

		$this->call(PermissionsSeeder::class);
	}
}
