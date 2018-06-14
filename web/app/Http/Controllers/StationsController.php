<?php

namespace App\Http\Controllers;

use App\Ambulance;
use App\Intervention;
use App\Station;
use App\Wilaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class StationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Role_SuperAdmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('station.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wilayas = Wilaya::all();
        return view('station.create')->with('wilayas', $wilayas);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $hopital =  Station::create([
            'designation' => request('designation'),
            'adresse' => request('adresse'),
            'wilaya' => request('wilaya'),
            'tel' => request('tel'),
            'email' => request('email'),
        ]);



        return redirect::to('/administration/station/'.$hopital->id)->with('message', 'Ajouté avec succes');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Station $station)
    {
        $wilayas = Wilaya::all();

        return view('station.show',['station'=>$station,'wilayas'=>$wilayas ]);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Station $station)
    {

        $wilayas = Wilaya::all();

        return view('station.edit', ['station'=>$station,'wilayas'=>$wilayas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $station = Station::find($request->id);
        $station->fill([
            'designation' => $request['designation'],
            'adresse' => $request['adresse'],
            'wilaya' => $request['wilaya'],
            'tel' => $request['tel'],
            'email' => $request['email'],
        ])->save();

        return Redirect::back()->with('message', 'Modifié avec succes');

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Station::destroy($id);
        return redirect::to('/administration/station/')->with('message', 'supprime avec succés');

    }



    // LES AMBULANCES
    public function storeambulance(Request $request)
    {

        Station::find($request->id)->ambulances()->create([
            'marque' => request('marque'),
            'matricule' => request('matricule'),
        ]);


        return Redirect::back()->with('message', 'Ajouté avec succes');
    }


    public function editambulance($id)
    {
        $ambulance = Ambulance::findOrFail($id);
        return view('station.ambulances.edit', ['ambulance'=>$ambulance ]);
    }

    public function updateambulance(Request $request)
    {
        $hopitalservice = HopitalService::find($request->id);
        $hopital  = Hopital::where('id',$hopitalservice->id)->first();
        $hopitalservice->fill([
            'lits' => $request['lits'],
        ])->save();

        return redirect::to('/administration/hopital/'.$hopital->id)->with('message', 'Modifié avec succes');

    }


    public function destroyambulance($id)
    {
        Ambulance::destroy($id);
        return redirect::back()->with('message', 'supprime avec succés');

    }






    public function getStationsData()
    {

        $hopitals = Station::select(['id','designation', 'wilaya', 'tel', 'email']);

        return Datatables::of($hopitals)
            ->addColumn('action', function ($hopital) {
                return '<a href="/administration/station/'. $hopital->id . '/" class="btn btn-xs btn-primary" >Visioner</a>
                <a href="/administration/station/'. $hopital->id . '/edit" class="btn btn-xs btn-warning" >Modifier</a>
                <a href="/administration/station/'. $hopital->id . '/destroy" class="btn btn-xs btn-danger">Supprimer</a>';

            })
            ->make(true);
    }


    public function getAmbulancesData($id)
    {

        $services = Station::find($id)->ambulances();

        return Datatables::of($services)->removeColumn('station_id')
            ->addColumn('action', function ($service) {
                return '<a href="/administration/station/ambulances/'. $service->id . '/edit" class="btn btn-xs btn-warning" >Modifier</a>
                <a href="/administration/station/ambulances/'. $service->id . '/destroy" class="btn btn-xs btn-danger">Supprimer</a>';

            })            ->make(true);
    }



}
