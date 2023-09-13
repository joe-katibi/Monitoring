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
            $table->string('title');
            $table->dateTime('date');
            $table->string('agent_name');
            $table->string('supervisor_name');
            $table->string('qa_name');
            $table->string('description');
            $table->string('fatal_error');
            $table->string('supervisor_comment');
            $table->longText('qa_signature');
            $table->dateTime('date_by_qa');
            $table->longText('supervisor_signature');
            $table->dateTime('date_by_supervisor');
            $table->longText('agent_signature');
            $table->dateTime('date_by_agent');
            $table->string('category_id');
            $table->string('results_id');
            $table->string('auto_status');
            $table->string('service_id');
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
