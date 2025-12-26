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
            // $table->unique(['agent_id', 'billing_period']);
            $table->id();
            $table->unique(['employee_id', 'periode_begin', 'periode_end']);
            $table->string('motif'); 
            $table->integer('restDay');  
            $table->integer('overtimes'); 
            $table->decimal('overtimesPay', 15, 2)->default(0.00);
            $table->decimal('assudityBonus', 15, 2)->default(0.00);
            $table->decimal('totalAmount', 15, 2)->default(0.00);
            $table->decimal('netAmount', 15, 2)->default(0.00);
            $table->decimal('riskBonus', 15, 2)->default(0.00);
            $table->decimal('performanceBonus', 10, 2)->default(0.00);
            $table->float('CNSS'); 
            $table->float('INPP');  
            $table->float('ONEM'); 
            $table->float('IPR'); 
            $table->float('refundAdvanceAmount');   
            $table->float('deductionSalary'); 
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
