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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->decimal('product_price', 8, 2);
            $table->integer('product_quantity');
            $table->enum('status', ['to_ship', 'to_recieve', 'completed', 'cancel', 'pending_refund','refund']);
            $table->enum('payment_method', ['cod', 'bank', 'paypal'])->default('cod');
            $table->enum('delivery_method', ['Deliver', 'Self_Collect'])->default('Deliver');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
