<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->unique();
            $table->integer('level');
            $table->integer('HP');
            $table->integer('AD');
            $table->integer('AP');
            $table->integer('armor');
            $table->integer('MR');
            $table->integer('peneArmor');
            $table->integer('peneMR');
            $table->text('picture');
            $table->string('type');
            $table->string('partie');
            $table->integer('prix');
            $table->string('idEvolution', 255)->nullable()->default(null);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('items');
    }
}
