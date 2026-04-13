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
        Schema::table('tags', function (Blueprint $table) {
            // Drop unique index on name if it exists
            try {
                $table->dropUnique('tags_name_unique');
            } catch (Throwable $e) {
                // index might not exist; ignore
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tags', function (Blueprint $table) {
            // Recreate unique constraint on name
            try {
                $table->unique('name');
            } catch (Throwable $e) {
                // ignore if already exists
            }
        });
    }
};
