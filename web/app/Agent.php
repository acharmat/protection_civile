<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'photo','matricule','nom','prenom','email','adresse','telephone', 'sexe','grade','date_n','lieu_n',
    ];

    public function station()
    {
        return $this->belongsTo('App\Station');
    }
}
