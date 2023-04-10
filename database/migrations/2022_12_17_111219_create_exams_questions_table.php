<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams_questions', function (Blueprint $table) {
            $table->id();
            $table->string('service');
            $table->string('category');
            // $table->string('question_weight');
            $table->string('course');
            $table->string('answer_key');
            $table->string('question');
            // $table->string('answer_a');
            // $table->string('answer_b');
            // $table->string('answer_c');
            // $table->string('answer_d');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams_questions');
    }
};
