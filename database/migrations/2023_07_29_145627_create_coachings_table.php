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
            $table->string('agent')->nullable();
            $table->string('record_id')->nullable();
            $table->string('supervisor')->nullable();
            $table->string('quality_analyst')->nullable();
            $table->string('date_coaching')->nullable();
            $table->string('scores')->nullable();
            $table->string('areas_of_strength')->nullable();
            $table->string('pervious_actions')->nullable();
            $table->string('current_areas_improvement')->nullable();
            $table->string('action_points_taken')->nullable();
            $table->string('agent_signature')->nullable();
            $table->string('agent_date_sign')->nullable();
            $table->string('supervisor_signature')->nullable();
            $table->string('supervisor_date_sign')->nullable();
            $table->string('quality_analyst_signature')->nullable();
            $table->string('quality_analyst_date_sign')->nullable();
            $table->string('results_id')->nullable();
            $table->string('category_id')->nullable();
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
        Schema::dropIfExists('coachings');
    }
};
