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
        Schema::create('training_packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_name');
            $table->integer('number_of_sessions');
            $table->foreignId("gym_id")->nullable()->references("id")->on("gyms")->nullOnDelete();
            $table->integer('price');
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
        Schema::dropIfExists('training_packages');
    }
};
