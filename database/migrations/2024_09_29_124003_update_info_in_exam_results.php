<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('exam_results', function (Blueprint $table) {
            $table->dateTime('finish_date')->nullable()->change();
            $table->integer('duration')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('exam_results', function (Blueprint $table) {
            //
        });
    }
};
