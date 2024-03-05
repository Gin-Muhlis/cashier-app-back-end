<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transaction_details', function (Blueprint $table) {
            Schema::table('transaction_details', function (Blueprint $table) {
                $table
                    ->foreign('entrusted_product_id')
                    ->references('id')
                    ->on('entrusted_products')
                    ->onUpdate('CASCADE')
                    ->onDelete('CASCADE');
    
                $table
                    ->foreign('menu_id')
                    ->references('id')
                    ->on('menus')
                    ->onUpdate('CASCADE')
                    ->onDelete('CASCADE');
    
                $table
                    ->foreign('transaction_id')
                    ->references('id')
                    ->on('transactions')
                    ->onUpdate('CASCADE')
                    ->onDelete('CASCADE');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_details', function (Blueprint $table) {
            //
        });
    }
};
