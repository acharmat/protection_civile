<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{


    protected $fillable = [
        'nom','prenom','email','adresse','telephone', 'sexe','etat','type', 'situation','groupage',
    ];


    public function hopital()
    {
        return $this->belongsTo('App\Hopital');
    }

    public function service()
    {
        return $this->belongsTo('App\HopitalService');
    }

    public function rapports()
    {
        return $this->hasMany('App\Rapport');
    }


}
