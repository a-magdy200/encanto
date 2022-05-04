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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
<<<<<<< HEAD:database/migrations/2014_10_12_000000_create_users_table.php
            $table->string('avatar')->default('default_avatar.jpg');
            //$table->foreignId('role_id')->default(5)->references("id")->on("roles");
=======
            $table->string('avatar')->default('/avatars/default.png');
            $table->foreignId('role_id')->default(5)->references("id")->on("roles");
>>>>>>> b84fb959f6aa3081323b4ee09f5a3ded89b62853:database/migrations/2022_04_28_121603_create_users_table.php
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
