<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Hopital extends Model
{

    use  Notifiable;


    public $timestamps = false;

    protected $fillable = [
        'type','designation', 'adresse','wilaya','tel','email', 'latitude','longitude',
    ];


    public function services()
    {
        return $this->belongsToMany('App\Service', 'hopital_service', 'hopital_id', 'service_id')->withPivot('lits');
    }

    public function interventions()
    {
        return $this->hasMany('App\Intervention');
    }

}
