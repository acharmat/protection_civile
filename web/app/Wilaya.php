<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wilaya extends Model
{
    public $timestamps = false;


    protected $fillable = [
        'code','nom'
    ];

}
