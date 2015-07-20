<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'level', 'HP', 'AD', 'AP', 'armor', 'MR', 'peneArmor', 'peneMR', 'picture', 'type', 'partie', 'prix', 'idEvolution', 'created_at', 'update_at'];
}
