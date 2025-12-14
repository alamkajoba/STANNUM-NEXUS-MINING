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
            $table->id();
            $table->string('motif'); 
            $table->integer('restDay');  
            $table->integer('overtimes'); 
            $table->float('assudityBonus'); 
            $table->float('totalAmount'); 
            $table->float('netAmount'); 
            $table->float('riskBonus'); 
            $table->float('performanceBonus'); 
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('employee_id');

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->foreign('employee_id')
                    ->references('id')
                    ->on('employees')
                    ->onDelete('cascade');
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
