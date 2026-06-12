<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\FunctionVehicleEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('function_types', function (Blueprint $table) {
            $table->id();
            $table->string('nameFunction'); 
            $table->bigInteger('amount')->default(0);
            $table->bigInteger('dayAmount')->default(0);
            $table->bigInteger('hourAmount')->default(0);
            $table->integer('workDay'); 
            $table->bigInteger('housing')->default(0);
            $table->bigInteger('transportationCost')->default(0); 
            $table->bigInteger('familialAllocation')->default(0); 
            $table->enum('functionVehicle', FunctionVehicleEnum::cases())->default(FunctionVehicleEnum::FALSE->value); 
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('user_id')->constrained()->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_types');
    }
};
