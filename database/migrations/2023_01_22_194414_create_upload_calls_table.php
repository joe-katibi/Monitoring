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
        Schema::create('upload_calls', function (Blueprint $table) {
            $table->id();
            $table->integer('agent_name')->nullable();
            $table->integer('supervisor_name')->nullable();
            $table->integer('call_category')->nullable();
            $table->integer('qa_name')->nullable();
            $table->integer('service_id')->nullable();
            $table->integer('call_rating')->nullable();
            $table->dateTime('call_date')->nullable();
            $table->string('call_file')->nullable();
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
        Schema::dropIfExists('upload_calls');
    }
};
