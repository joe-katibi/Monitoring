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
            $table->string('agent');
            $table->string('record_id');
            $table->string('supervisor');
            $table->string('quality_analyst');
            $table->string('date_coaching');
            $table->string('scores');
            $table->string('areas_of_strength');
            $table->string('pervious_actions');
            $table->string('current_areas_improvement');
            $table->string('action_points_taken');
            $table->string('agent_signature');
            $table->string('agent_date_sign');
            $table->string('supervisor_signature');
            $table->string('supervisor_date_sign');
            $table->string('quality_analyst_signature');
            $table->string('quality_analyst_date_sign');
            $table->string('results_id');
            $table->string('category_id');
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
