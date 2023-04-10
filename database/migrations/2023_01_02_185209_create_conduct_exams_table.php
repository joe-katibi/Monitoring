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
        Schema::create('conduct_exams', function (Blueprint $table) {
            $table->id();
            $table->string('schedule_name');
            $table->string('time');
            $table->string('course');
            $table->string('exam_name');
            $table->string('service');
            $table->string('category');
            $table->string('trainer_qa');
            $table->string('start_date');
            $table->string('completion_date');
            $table->string('created_by');
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
        Schema::dropIfExists('conduct_exams');
    }
};
