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
        Schema::create('answer_keys', function (Blueprint $table) {
            $table->id();
            $table->integer('question_id')->nullable();
            $table->string('choices')->nullable();
            $table->integer('question_weight')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('key_choice')->nullable();
            $table->integer('is_correct')->nullable();
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
        Schema::dropIfExists('answer_keys');
    }
};
