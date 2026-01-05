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
        Schema::create('advance_repayments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('advance_id');
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->decimal('amount', 15, 2);
            $table->unsignedBigInteger('user_id');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->foreign('advance_id')->references('id')->on('advances')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advance_repayments');
    }
};
