<?php

namespace App\Http\Controllers;

use App\Hopital;
use App\HopitalService;
use App\Http\Resources\InterventionResource;
use App\Intervention;
use App\Notifications\InterventionSent;
use App\Service;

use App\Http\Resources\ServiceCollection;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $intervention->groupage = $request->groupage;
        $intervention->adresse = $request->adresse;
        $intervention->telephone = $request->telephone;
        $intervention->email = $request->email;
        $intervention->wilaya = $request->wilaya;
        $intervention->hopital_id = $request->hopital_id;

        $intervention->save();
        Hopital::find($request->hopital_id)->notify(new InterventionSent($intervention));




        return response([
            'data' => new InterventionResource($intervention)
        ],Response::HTTP_CREATED) ;
    }




}



