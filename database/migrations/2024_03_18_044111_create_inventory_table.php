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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->string('itemName');
            $table->string('specification')->nullable();
            $table->integer('rmeQuantity')->default(0);
            $table->integer('gudang4Quantity')->default(0);
            $table->integer('gudang12Quantity')->default(0);
            $table->string('description')->nullable();
            $table->boolean('stock');
            $table->boolean('visible');
            $table->string('barcode')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
