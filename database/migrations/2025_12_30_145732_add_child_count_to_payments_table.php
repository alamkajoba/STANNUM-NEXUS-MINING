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
        // Guard against duplicate column when running migrations in test environments
        if (!Schema::hasColumn('payments', 'childCount')) {
            Schema::table('payments', function (Blueprint $table) {
                $table->integer('childCount')->default(0)->after('IPR');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('payments', 'childCount')) {
            Schema::table('payments', function (Blueprint $table) {
                $table->dropColumn('childCount');
            });
        }
    }
};
