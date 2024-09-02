<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('groups')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('packet_id')->constrained('packets')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->string('name')->unique();
            $table->integer('duration');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->text('desc')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
