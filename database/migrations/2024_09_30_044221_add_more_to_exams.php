<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->string('token')->nullable();
            $table->tinyInteger('public_results')->nullable()->default(0);
            $table->tinyInteger('auto_grade')->nullable()->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('exams', function (Blueprint $table) {
            //
        });
    }
};
