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
        Schema::create('coachings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->integer('agent')->nullable();
            $table->integer('record_id')->nullable();
            $table->integer('supervisor')->nullable();
            $table->integer('quality_analyst')->nullable();
            $table->integer('coaching_status')->nullable();
            $table->dateTime('date_coaching')->nullable();
            $table->integer('scores')->nullable();
            $table->string('areas_of_strength')->nullable();
            $table->string('pervious_actions')->nullable();
            $table->string('current_areas_improvement')->nullable();
            $table->string('action_points_taken')->nullable();
            $table->longText('agent_signature')->nullable();
            $table->dateTime('agent_date_sign')->nullable();
            $table->longText('supervisor_signature')->nullable();
            $table->dateTime('supervisor_date_sign')->nullable();
            $table->longText('quality_analyst_signature')->nullable();
            $table->dateTime('quality_analyst_date_sign')->nullable();
            $table->integer('results_id')->nullable();
            $table->integer('category_id')->nullable();
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
        Schema::dropIfExists('coachings');
    }
};
