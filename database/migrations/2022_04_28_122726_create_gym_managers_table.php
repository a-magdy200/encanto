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
        Schema::create('gym_managers', function (Blueprint $table) {
            $table->bigInteger('national_id')->unique();
            $table->boolean('is_banned');
            $table->foreignId('gym_id')->references('id')->on('gyms');
        });
    }
    public function down()
    {
        Schema::dropIfExists('gym_managers');
    }
};
