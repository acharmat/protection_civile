<?php

namespace App\Http\Controllers;

use App\Hopital;
use App\HopitalService;
use App\Http\Resources\InterventionResource;
use App\Intervention;
use App\Service;

use App\Http\Resources\ServiceCollection;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class ApiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('index');
    }

    public function index()
    {
        return ServiceCollection::collection(HopitalService::all());
    }


    public function store(Request $request)
    {
       $intervention = new Intervention;
        $intervention->nom = $request->nom;
        $intervention->prenom = $request->prenom;
        $intervention->age = $request->age;
        $intervention->sexe = $request->sexe;
        $intervention->type = $request->type;
        $intervention->etat = $request->etat;
        $intervention->wilaya = $request->wilaya;

        $intervention->save();


        return response([
            'data' => new InterventionResource($intervention)
        ],Response::HTTP_CREATED) ;
    }




}



