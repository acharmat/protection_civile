<?php

namespace App\Http\Resources;

use App\Hopital;
use App\Service;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ServiceCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'hopital' => Hopital::where( 'id' , $this->hopital_id)->get(),
            'service' => Service::where( 'id' , $this->service_id)->get(),
            'lits' => $this->lits,

        ];
    }
}
