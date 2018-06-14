<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{


    protected $fillable = [
        'nom','prenom','email','adresse','telephone', 'sexe','etat','type',
    ];


    public function hopital()
    {
        return $this->belongsTo('App\Hopital');
    }
}
