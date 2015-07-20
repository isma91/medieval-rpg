<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Model::unguard();

        // $this->call(UserTableSeeder::class);

        Model::reguard();*/

        DB::table('items')->insert([
            'name' => 'doran ring',
            'level' => 1,
            'HP' => 60,
            'AD' => 0,
            'AP' => 15,
            'armor' => 0,
            'MR' => 0,
            'peneArmor' => 0,
            'peneMR' => 0,
            'picture' => 'doran_ring.png',
            'type' => 'bague',
            'partie' => 'doigt',
            'prix' => 400,
            'created_at' => DB::raw('now()')]);
        DB::table('items')->insert([
            'name' => 'doran blade',
            'level' => 1,
            'HP' => 70,
            'AD' => 7,
            'AP' => 0,
            'armor' => 0,
            'MR' => 0,
            'peneArmor' => 0,
            'peneMR' => 0,
            'picture' => 'doran_blade.png',
            'type' => 'épée',
            'partie' => 'mains',
            'prix' => 440,
            'created_at' => DB::raw('now()')]);
        DB::table('items')->insert([
            'name' => 'doran shield',
            'level' => 1,
            'HP' => 80,
            'AD' => 0,
            'AP' => 15,
            'armor' => 0,
            'MR' => 0,
            'peneArmor' => 0,
            'peneMR' => 0,
            'picture' => 'doran_shield.png',
            'type' => 'bouclier',
            'partie' => 'mains',
            'prix' => 440,
            'created_at' => DB::raw('now()')]);
        DB::table('items')->insert([
            'name' => 'cloth armor',
            'level' => 1,
            'HP' => 0,
            'AD' => 0,
            'AP' => 0,
            'armor' => 15,
            'MR' => 0,
            'peneArmor' => 0,
            'peneMR' => 0,
            'picture' => 'cloth_armor.png',
            'type' => 'armure',
            'partie' => 'corps',
            'prix' => 300,
            'created_at' => DB::raw('now()')]);
        DB::table('items')->insert([
            'name' => 'null magic mantle',
            'level' => 1,
            'HP' => 0,
            'AD' => 0,
            'AP' => 0,
            'armor' => 0,
            'MR' => 25,
            'peneArmor' => 0,
            'peneMR' => 0,
            'picture' => 'null_magic_mantle.png',
            'type' => 'bouclier',
            'partie' => 'mains',
            'prix' => 500,
            'created_at' => DB::raw('now()')]);
    }
}
