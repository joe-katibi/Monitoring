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
        Schema::create('live_calls_results', function (Blueprint $table) {
            $table->id();
            $table->integer('live_call_id')->nullable();
            $table->integer('strength_id')->nullable();
            $table->integer('summary_id')->nullable();
            $table->integer('service_id')->nullable();
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
        Schema::dropIfExists('live_calls_results');
    }
};
