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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('nameCategory'); 
            $table->decimal('amount', 15, 2)->default(0.00);
            $table->decimal('dayAmount', 15, 2)->default(0.00);
            $table->decimal('hourAmount', 15, 2)->default(0.00);
            $table->integer('workDay'); 
            $table->decimal('housing', 15, 2)->default(0.00);
            $table->decimal('transportationCost', 15, 2)->default(0.00); 
            $table->decimal('familialAllocation', 15, 2)->default(0.00); 
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
