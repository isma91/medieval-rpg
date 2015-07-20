<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PNJ extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pnjs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'HP', 'AD', 'AP', 'armor', 'MR', 'peneArmor', 'peneMR', 'picture', 'idMaster', 'level', 'created_at', 'update_at'];
}
