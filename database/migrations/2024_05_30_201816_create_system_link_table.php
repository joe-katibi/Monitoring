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
        Schema::create('system_links', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->integer('link_status')->nullable();
            $table->string('site_url')->nullable();
            $table->string('site_image')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('services_system_link', function (Blueprint $table) {
            $table->id();
            $table->foreignId('system_link_id')->constrained('system_links');
            $table->foreignId('services_id')->constrained('services');
            $table->timestamps();
        });

        Schema::create('countries_system_link', function (Blueprint $table) {
            $table->id();
            $table->foreignId('system_link_id')->constrained('system_links');
            $table->foreignId('countries_id')->constrained('countries');
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
        Schema::dropIfExists('system_links');
        Schema::dropIfExists('services_system_link');
        Schema::dropIfExists('countries_system_link');
    }
};
