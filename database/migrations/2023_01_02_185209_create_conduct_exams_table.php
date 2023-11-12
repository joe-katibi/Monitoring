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
            $table->string('time')->nullable();
            $table->string('course')->nullable();
            $table->string('exam_name')->nullable();
            $table->string('service')->nullable();
            $table->string('category')->nullable();
            $table->string('trainer_qa')->nullable();
            $table->string('start_date')->nullable();
            $table->string('completion_date')->nullable();
            $table->string('created_by')->nullable();
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
