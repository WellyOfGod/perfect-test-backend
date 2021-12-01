<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quantity');
            $table->unsignedDecimal('discount')->nullable();
            $table->unsignedDecimal('total');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('sale_situation_id')->constrained('sale_situations');
            $table->foreignId('customers_id')->constrained('customers');
            $table->datetime('sale_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
}
