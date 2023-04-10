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
        Schema::create('fiber_welcome_questions', function (Blueprint $table) {
            $table->id();
            $table->boolean('number');
            $table->string('question');
            $table->string('summarized');
            $table->string('yes');
            $table->string('no');
            $table->string('service');
            $table->string('category');
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
        Schema::dropIfExists('fiber_welcome_questions');
    }
};
