<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HopitalService extends Model
{
    protected $table ='hopital_service';


    protected $fillable = [
        'id','lits','hopital_id','service_id',
    ];


}
