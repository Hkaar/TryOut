<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);

            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });

        Schema::table('packets', function (Blueprint $table) {
            $table->dropForeign(['group_id']);
            $table->dropForeign(['subject_id']);

            $table->foreign('group_id')
                ->references('id')
                ->on('groups')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign('subject_id')
                ->references('id')
                ->on('subjects')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });

        Schema::table('questions', function (Blueprint $table) {
            $table->dropForeign(['packet_id']);
            $table->dropForeign(['question_type_id']);

            $table->foreign('packet_id')
                ->references('id')
                ->on('packets')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign('question_type_id')
                ->references('id')
                ->on('question_types')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });

        Schema::table('question_choices', function (Blueprint $table) {
            $table->dropForeign(['question_id']);

            $table->foreign('question_id')
                ->references('id')
                ->on('questions')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    public function down(): void
    {
        //
    }
};
