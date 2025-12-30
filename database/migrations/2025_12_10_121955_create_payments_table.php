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
            $table->unique(['employee_id', 'motif']);
            $table->string('motif'); 
            $table->float('CNSS'); 
            $table->float('INPP');  
            $table->float('ONEM'); 
            $table->float('IPR'); 
            $table->integer('childCount');
            $table->decimal('baseSalary', 10, 2)->default(0.00);
            $table->integer('dayMounth');
            $table->integer('justifyDay');
            $table->integer('workDay');
            $table->decimal('baseMounthlyDay', 10, 2)->default(0.00);
            $table->decimal('overtimesPay', 10, 2)->default(0.00);
            $table->decimal('housingDay', 10, 2)->default(0.00);
            $table->decimal('housingMounth', 10, 2)->default(0.00);
            $table->decimal('transportationCostDay', 10, 2)->default(0.00);
            $table->decimal('transportationCostMounth', 10, 2)->default(0.00);
            $table->decimal('familialAllocationDay', 10, 2)->default(0.00);
            $table->decimal('familialAllocationMounth', 10, 2)->default(0.00);
            $table->decimal('totalAdvantage', 10, 2)->default(0.00);
            $table->decimal('deductionSalary', 10, 2)->default(0.00);
            $table->decimal('refund', 10, 2)->default(0.00);
            $table->decimal('CNSSAmount', 10, 2)->default(0.00);
            $table->decimal('INPPAmount', 10, 2)->default(0.00);
            $table->decimal('ONEMAmount', 10, 2)->default(0.00);
            $table->decimal('IPRAmount', 10, 2)->default(0.00);
            $table->decimal('deductionSalaryAmount', 10, 2)->default(0.00);
            $table->decimal('refundAmount', 10, 2)->default(0.00);
            $table->decimal('totalDeduction', 10, 2)->default(0.00);
            $table->decimal('brutSalary', 10, 2)->default(0.00);
            $table->decimal('netSalary', 10, 2)->default(0.00);

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
