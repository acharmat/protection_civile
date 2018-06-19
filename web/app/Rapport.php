<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    protected $fillable = [
        'body',
    ];

    public function intervention()
    {
        return $this->belongsTo('App\Intervention');
    }
}
