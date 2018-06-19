<?php

namespace App\Http\Controllers;

use App\Hopital;
use App\HopitalService;
use App\Intervention;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\In;
use Yajra\DataTables\Facades\DataTables;

class InterventionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Role_HopitalAdmin');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('HopitalAdmin.intervention.index');
    }


    public function edit(Intervention $intervention)
    {
        return view('HopitalAdmin.intervention.edit', ['intervention'=>$intervention]);
    }

    public function update(Request $request)
    {
        $intervention = Intervention::find($request->id);
        $intervention->fill([
            'type' => $request['type'],
            'designation' => $request['designation'],
            'adresse' => $request['adresse'],
            'wilaya' => $request['wilaya'],
            'latitude' => $request['latitude'],
            'longitude' => $request['longitude'],
            'tel' => $request['tel'],
            'email' => $request['email'],
        ])->save();

        return Redirect::back()->with('message', 'Modifié avec succes');

    }



    public function show(Intervention $intervention)
    {

        $services  =  Hopital::findOrFail(Role::find(2)->users()->where('user_id',Auth::user()->id)->first()->pivot->post_id)->services()->get();
        return view('HopitalAdmin.intervention.show',['intervention'=>$intervention, 'services'=> $services ]);
    }



    public function admission(Request $request)
    {

        $service = HopitalService::where([
                ['service_id', '=', $request->service],
                ['hopital_id', '=', $request->hopital],
            ])->first();
        $service->lits = $service->lits-1;
        $service->save();

        $intervention = Intervention::find($request->id);
        $intervention->service_id = $request->service;
        $intervention->situation = "hospitaliser";
        $intervention->save();


        return Redirect::back()->with('message', 'Hospitaliser!');
    }


    public function libirer(Request $request)
    {

        $intervention = Intervention::find($request->id);


        $service = HopitalService::where([
            ['service_id', '=', $intervention->service_id],
            ['hopital_id', '=', $intervention->hopital_id],
        ])->first();
        $service->lits = $service->lits+1;
        $service->save();

        $intervention->service_id = null;
        $intervention->situation = "non hospitaliser";
        $intervention->save();



        return Redirect::back()->with('message', 'Libirer!');
    }

    /**
     * @return mixed
     */
    public function getInterventionData()
    {

        $user = Role::find(2)->users()->where('user_id',Auth::user()->id)->first()->pivot->post_id;

        $interventions = Hopital::find($user)->interventions();

        return Datatables::of($interventions)
            ->addColumn('action', function ($intervention) {
                return '<a href="/hopital/interventions/'. $intervention->id . '/" class="btn btn-xs btn-primary" >Visionner</a>
                <a href="/hopital/interventions/'. $intervention->id . '/edit" class="btn btn-xs btn-warning" >Modifier</a>
                <a href="/hopital/interventions/'. $intervention->id . '/destroy" class="btn btn-xs btn-danger">Supprimer</a>';

            })            ->make(true);
    }



}
