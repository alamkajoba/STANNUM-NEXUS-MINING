<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\RelationTypeEnum;
use App\Enums\GenderEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('family_states', function (Blueprint $table) {
            $table->id();
            $table->string('middleName');
            $table->string('lastName');
            $table->string('firstName');
            $table->string('birthTown');
            $table->date('birthDate');
            $table->enum('relationType', RelationTypeEnum::cases());
            $table->enum('gender', GenderEnum::cases());
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
        Schema::dropIfExists('family_states');
    }
};
