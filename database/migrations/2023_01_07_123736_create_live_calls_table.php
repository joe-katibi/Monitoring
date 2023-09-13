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
        Schema::create('live_calls', function (Blueprint $table) {
            $table->id();
            $table->string('tittle')->nullable();
            $table->string('account_number')->nullable();
            $table->string('recording_id')->nullable();
            $table->string('date')->nullable();
            $table->string('quality_analysts')->nullable();
            $table->string('category')->nullable();
            $table->string('supervisor')->nullable();
            $table->string('agent')->nullable();
            $table->string('issue_summary')->nullable();
            $table->string('issue_description')->nullable();
            $table->string('strength_summary')->nullable();
            $table->string('strength_description')->nullable();
            $table->string('gaps_summary')->nullable();
            $table->string('gaps_description')->nullable();
            $table->string('voc_summary')->nullable();
            $table->string('voc_description')->nullable();
            $table->string('report_type_id')->nullable();
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
        Schema::dropIfExists('live_calls');
    }
};
