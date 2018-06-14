<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'designation', 'adresse','wilaya','tel','email',
    ];


    public function ambulances()
    {
        return $this->hasMany('App\Ambulance');
    }

    public function agents()
    {
        return $this->hasMany('App\Agent');
    }

}
