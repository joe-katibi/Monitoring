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
            $table->boolean('number')->nullable();
            $table->string('question')->nullable();
            $table->string('summarized')->nullable();
            $table->string('yes')->nullable();
            $table->string('no')->nullable();
            $table->string('service')->nullable();
            $table->string('category')->nullable();
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
        Schema::dropIfExists('fiber_welcome_questions');
    }
};
