<?php
/// ETML
/// Author      : Santiago Escobar Toro
/// Date        : 2025-05-28
/// Description : creation of manage table
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
        Schema::create('t_manage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->references('id')->on('t_admin')->onDelete('cascade');
            $table->foreignId('product_id')->references('id')->on('t_product')->onDelete('cascade');
            $table->foreignId('order_id')->references('id')->on('t_order')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_manage');
    }
};
