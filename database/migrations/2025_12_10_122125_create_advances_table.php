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
        Schema::create('advances', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 15, 2)->default(0.00);
            $table->decimal('toRefund', 15, 2)->default(0.00);
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('user_id')->constrained()->onDelete('restrict');

            $table->foreignId('employee_id')->constrained()->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advances');
    }
};
