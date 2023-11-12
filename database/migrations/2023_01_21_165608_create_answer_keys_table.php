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
            $table->string('question_id')->nullable();
            $table->string('choices')->nullable();
            $table->string('question_weight')->nullable();
            $table->string('created_by')->nullable();
            $table->string('key_choice')->nullable();
            $table->string('is_correct')->nullable();
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
