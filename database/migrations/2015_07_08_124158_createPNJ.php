<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePNJ extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pnjs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->unique();
            $table->integer('HP');
            $table->integer('AD');
            $table->integer('AP');
            $table->integer('armor');
            $table->integer('MR');
            $table->integer('peneArmor');
            $table->integer('peneMR');
            $table->text('picture');
            $table->integer('idMaster');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->integer('level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pnjs');
    }
}
