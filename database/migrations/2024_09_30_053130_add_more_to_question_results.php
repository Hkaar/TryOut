<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('question_results', function (Blueprint $table) {
            $table->tinyInteger('not_sure')->nullable()->default(0);
            $table->tinyInteger('correct')->nullable()->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('question_results', function (Blueprint $table) {
            //
        });
    }
};
