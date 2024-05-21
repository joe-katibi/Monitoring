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
            $table->string('schedule_name')->nullable();
            $table->integer('time')->nullable();
            $table->integer('course')->nullable();
            $table->string('exam_name')->nullable();
            $table->integer('service')->nullable();
            $table->integer('category')->nullable();
            $table->integer('trainer_qa')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('completion_date')->nullable();
            $table->integer('created_by')->nullable();
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
