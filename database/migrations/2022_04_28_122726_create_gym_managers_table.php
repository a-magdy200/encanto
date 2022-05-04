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
            $table->id();
            $table->bigInteger('national_id')->unique();
            $table->boolean('is_banned')->default(false);
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('gym_id')->nullable()->references('id')->on('gyms');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('gym_managers');
    }
};
