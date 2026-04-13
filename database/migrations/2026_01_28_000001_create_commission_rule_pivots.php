<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('commission_rule_project', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commission_rule_id')->constrained('commission_rules')->cascadeOnDelete();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['commission_rule_id','project_id']);
        });

        Schema::create('commission_rule_principal_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commission_rule_id')->constrained('commission_rules')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['commission_rule_id','user_id']);
        });

        Schema::create('commission_rule_secondary_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commission_rule_id')->constrained('commission_rules')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['commission_rule_id','user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commission_rule_secondary_user');
        Schema::dropIfExists('commission_rule_principal_user');
        Schema::dropIfExists('commission_rule_project');
    }
};
