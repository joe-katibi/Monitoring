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
        Schema::create('alert_forms', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->dateTime('date')->nullable();
            $table->integer('agent_name')->nullable();
            $table->integer('supervisor_name')->nullable();
            $table->integer('qa_name')->nullable();
            $table->string('description')->nullable();
            $table->string('fatal_error')->nullable();
            $table->string('supervisor_comment')->nullable();
            $table->longText('qa_signature')->nullable();
            $table->dateTime('date_by_qa')->nullable();
            $table->longText('supervisor_signature')->nullable();
            $table->dateTime('date_by_supervisor')->nullable();
            $table->longText('agent_signature')->nullable();
            $table->dateTime('date_by_agent')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('results_id')->nullable();
            $table->integer('auto_status')->nullable();
            $table->integer('service_id')->nullable();
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
        Schema::dropIfExists('alert_forms');
    }
};
