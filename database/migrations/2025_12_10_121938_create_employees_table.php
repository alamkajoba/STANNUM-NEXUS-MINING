<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\GenderEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            
            $table->id();
            $table->string('firstName'); 
            $table->string('middleName'); 
            $table->string('lastName'); 
            $table->date('birthDate');
            $table->string('birthTown'); 
            $table->string('address'); 
            $table->enum('gender', GenderEnum::cases());
            $table->string('phone'); 
            $table->string('mail')->nullable(); 
            $table->string('emergencyPhone')->nullable();
            $table->string('nationality'); 
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
        Schema::dropIfExists('employees');
    }
};
