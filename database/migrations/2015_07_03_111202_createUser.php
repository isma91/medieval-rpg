<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lastname', 100);
            $table->string('name', 100);
            $table->string('username', 100)->unique();
            $table->string('password', 100);
            $table->string('birthdate');
            $table->string('email')->unique();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->text('remember_token');
            $table->integer('level')->default(1);
            $table->integer('xp')->default(0);
            $table->text('picture')->nullable();
            $table->string('droit', 100);
            $table->string('bloquer', 3);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
