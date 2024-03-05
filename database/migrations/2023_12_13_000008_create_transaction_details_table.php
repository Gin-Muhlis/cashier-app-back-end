<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('transaction_details', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->double('sub_total');
			$table->double('unit_price');
			$table->integer('quantity');
			$table->unsignedBigInteger('menu_id')->nullable();
			$table->unsignedBigInteger('entrusted_product_id')->nullable();
			$table->unsignedBigInteger('transaction_id');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('transaction_details');
	}
};
