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
        Schema::create('sub_issue_generals', function (Blueprint $table) {
            $table->id();
            $table->string('sub_name')->nullable();
            $table->string('issue_general_id')->nullable();
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
        Schema::dropIfExists('sub_issue_generals');
    }
};
