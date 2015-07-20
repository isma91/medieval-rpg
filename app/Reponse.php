<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reponses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['answer', 'idMaster', 'idAsk', 'created_at', 'update_at'];
}
