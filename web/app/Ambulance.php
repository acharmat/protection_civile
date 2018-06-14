<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    public $timestamps = false;

    protected $fillable = [
         'marque','matricule',
    ];

    public function station()
    {
        return $this->belongsTo('App\Station');
    }
}
