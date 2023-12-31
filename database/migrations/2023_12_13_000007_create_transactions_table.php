<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('transactions', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->date('date');
			$table->double('total_payment');
			$table->unsignedBigInteger('payment_method_id');
			$table->text('description');
			$table->unsignedBigInteger('user_id');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('transactions');
	}
};
