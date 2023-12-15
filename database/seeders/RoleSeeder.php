<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 */
	public function run(): void {
		collect([
			'admin',
			'kasir',
		])->each(function ($items) {
			DB::table('roles')->insert([
				'name' => $items,
			]);
		});
	}
}
