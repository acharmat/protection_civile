<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{


    public $timestamps = false;


    protected $fillable = [
        'designation',
    ];


    public function hopital()
    {
        return $this->belongsToMany('App\Hopital');
    }




}
