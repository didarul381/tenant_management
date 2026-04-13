<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('commission_rules', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('total_percentage');
            $table->unsignedTinyInteger('principal_percentage');
            $table->unsignedTinyInteger('secondary_percentage');
            $table->unsignedInteger('priority');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commission_rules');
    }
};
