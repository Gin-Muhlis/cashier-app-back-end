<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::table('menus', function (Blueprint $table) {
			$table
				->foreign('type_id')
				->references('id')
				->on('types')
				->onUpdate('CASCADE')
				->onDelete('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::table('menus', function (Blueprint $table) {
			$table->dropForeign(['type_id']);
			$table->dropForeign(['stock_id']);
		});
	}
};
