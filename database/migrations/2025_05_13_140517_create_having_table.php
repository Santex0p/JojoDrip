<?php
/// ETML
/// Author      : Santiago Escobar Toro
/// Date        : 2025-05-28
/// Description : creation of having table
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
            $table->timestamps();
            $table->foreignId('product_id')->references('id')->on('t_product')->onDelete('cascade');
            $table->foreignId('order_id')->references('id')->on('t_order')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_having');
    }
};
