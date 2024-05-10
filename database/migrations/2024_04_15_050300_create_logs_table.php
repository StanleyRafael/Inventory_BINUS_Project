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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key referencing 'normal_user' table
            $table->string('itemName');
            $table->integer('rmeQuantity')->default(0);
            $table->integer('gudang4Quantity')->default(0);
            $table->integer('gudang12Quantity')->default(0);
            $table->string('reason')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('normal_user')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
