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
            $table->string('live_call_id')->nullable();
            $table->string('strength_id')->nullable();
            $table->string('summary_id')->nullable();
            $table->string('service_id')->nullable();
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
        Schema::dropIfExists('live_calls_results');
    }
};
