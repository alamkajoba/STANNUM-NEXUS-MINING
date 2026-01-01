<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\CategoryProfEnum;
use App\Enums\EchelonEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->string('proMail')->nullable();
            $table->string('proPhone')->nullable();
            $table->string('section')->nullable();
            $table->string('department')->nullable();
            $table->string('site')->nullable();
            $table->enum('professionalCategory', CategoryProfEnum::cases());
            $table->enum('echelon', EchelonEnum::cases());
            $table->string('matricule')->nullable();
            $table->string('cnssNumber')->nullable();
            $table->string('acountNumber')->nullable();
            $table->date('startDate')->nullable();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('function_type_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('employee_id')
                    ->references('id')
                    ->on('employees')
                    ->onDelete('restrict');
                    
            $table->foreign('function_type_id')
                    ->references('id')
                    ->on('function_types')
                    ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
