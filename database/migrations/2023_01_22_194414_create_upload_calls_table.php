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
            $table->string('agent_name')->nullable();
            $table->string('supervisor_name')->nullable();
            $table->string('call_category')->nullable();
            $table->string('qa_name')->nullable();
            $table->string('service_id')->nullable();
            $table->string('call_rating')->nullable();
            $table->string('call_date')->nullable();
            $table->string('call_file')->nullable();
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
        Schema::dropIfExists('upload_calls');
    }
};
