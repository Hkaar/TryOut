<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('question_choices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('questions');
            $table->text('content');
            $table->tinyInteger('correct');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('question_choices');
    }
};
