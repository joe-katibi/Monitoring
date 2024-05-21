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
            $table->integer('account_number')->nullable();
            $table->integer('recording_id')->nullable();
            $table->dateTime('date')->nullable();
            $table->integer('quality_analysts')->nullable();
            $table->integer('category')->nullable();
            $table->integer('supervisor')->nullable();
            $table->integer('agent')->nullable();
            $table->string('issue_summary')->nullable();
            $table->string('issue_description')->nullable();
            $table->integer('strength_summary')->nullable();
            $table->string('strength_description')->nullable();
            $table->integer('gaps_summary')->nullable();
            $table->string('gaps_description')->nullable();
            $table->integer('voc_summary')->nullable();
            $table->string('voc_description')->nullable();
            $table->integer('report_type_id')->nullable();
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
        Schema::dropIfExists('live_calls');
    }
};
