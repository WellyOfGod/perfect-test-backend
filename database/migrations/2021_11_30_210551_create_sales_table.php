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
            $table->foreignId('product_id')->constrained('products')->onDelete('CASCADE');
            $table->foreignId('sale_situation_id')->constrained('sale_situations')->onDelete('CASCADE');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('CASCADE');
            $table->datetime('sold_at')->nullable();
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
