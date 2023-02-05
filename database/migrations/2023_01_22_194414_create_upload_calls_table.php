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
            $table->string('agent_name');
            $table->string('supervisor_name');
            $table->string('call_category');
            $table->string('qa_name');
            $table->string('call_rating');
            $table->string('call_date');
            $table->string('call_file');
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
