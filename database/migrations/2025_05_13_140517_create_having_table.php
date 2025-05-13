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
        Schema::create('t_having', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('product_id');
            $table->integer('order_id');
            $table->timestamps();
            $table->foreignId('admin_id')->references('id')->on('t_admin')->onDelete('cascade');
            $table->foreignId('product_id')->references('id')->on('t_product')->onDelete('cascade');
            $table->foreignId('order_id')->references('id')->on('t_order')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('having');
    }
};
