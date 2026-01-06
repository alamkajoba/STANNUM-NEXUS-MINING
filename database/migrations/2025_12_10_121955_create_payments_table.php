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
        Schema::create('payments', function (Blueprint $table) {
            $table->unique(['employee_id', 'motif']);
            $table->id();
            $table->date('motif');
            $table->bigInteger('netSalary')->default(0);
            $table->json('slipPrint')->nullable();
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
        Schema::dropIfExists('payments');
    }
};
