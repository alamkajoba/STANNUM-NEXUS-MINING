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
            //Personnal info and profil
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

            //Professional info
            $table->string('matricule');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');
            $table->string('proMail')->nullable();
            $table->string('proPhone')->nullable();
            $table->string('jobTitle');
            $table->string('affectation');
            $table->timestamps();

            

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    ->onDelete('cascade');
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
