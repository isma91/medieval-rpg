<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonnage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->unique();
            $table->integer('level')->default(1);
            $table->integer('skillPoint');
            $table->integer('HP')->default(10);
            $table->integer('AD')->default(1);
            $table->integer('AP')->default(0);
            $table->integer('armor')->default(0);
            $table->integer('MR')->default(0);
            $table->integer('peneArmor')->default(0);
            $table->integer('peneMR')->default(0);
            $table->integer('xp')->default(0);
            $table->integer('argent')->default(475);
            $table->text('picture')->nullable()->default(null);
            $table->text('tete')->nullable()->default(null);
            $table->text('visage')->nullable()->default(null);
            $table->text('gorge')->nullable()->default(null);
            $table->text('mains')->nullable()->default(null);
            $table->text('doigts')->nullable()->default(null);
            $table->text('coprs')->nullable()->default(null);
            $table->text('hanche')->nullable()->default(null);
            $table->integer('currentQuete)')->default(0);
            $table->integer('currentEtape')->default(0);
            $table->integer('idPlayer');
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
        //
    }
}
