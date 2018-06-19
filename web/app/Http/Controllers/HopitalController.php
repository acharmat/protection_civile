<?php

namespace App\Http\Controllers;

use App\Commune;
use App\Hopital;
use App\HopitalService;
use App\Role;
use App\Service;
use App\User;
use App\Wilaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;


class HopitalController extends Controller
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

        return view('hopital.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wilayas = Wilaya::all();
        return view('hopital.create')->with('wilayas', $wilayas);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $hopital =  Hopital::create([
            'type' => request('type'),
            'designation' => request('designation'),
            'adresse' => request('adresse'),
            'wilaya' => request('wilaya'),
            'latitude' => request('latitude'),
            'longitude' => request('longitude'),
            'tel' => request('tel'),
            'email' => request('email'),
        ]);



        return redirect::to('/administration/hopital/'.$hopital->id)->with('message', 'Ajouté avec succes');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Hopital $hopital)
    {
        $wilayas = Wilaya::all();

        $id = $hopital->id;
        $services = Service::whereDoesntHave('hopital', function($q) use ($id){
            $q->where('hopital_id', $id);
        })->get();



        return view('hopital.show',['hopital'=>$hopital,'wilayas'=>$wilayas,'services' =>$services ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Hopital $hopital)
    {

        $wilayas = Wilaya::all();

        return view('hopital.edit', ['hopital'=>$hopital,'wilayas'=>$wilayas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $hopital = Hopital::find($request->id);
        $hopital->fill([
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



    public function storeservice(Request $request)
    {

        Hopital::find($request->id)->services()->attach(
            $request->get('service') , ['lits' => $request->get('lits')]);


        return Redirect::back()->with('message', 'Ajouté avec succes');
    }

    public function editservice($id)
    {
        $hopitalservice = HopitalService::findOrFail($id);
        $service  = Service::findOrFail($hopitalservice->service_id);
        $hopital  = Hopital::findOrFail($hopitalservice->hopital_id);


        return view('hopital.services.edit', ['hopitalservice'=>$hopitalservice , 'service'=>$service, 'hopital'=>$hopital]);
    }

    public function updateservice(Request $request)
    {
        $hopitalservice = HopitalService::find($request->id);
        $hopital  = Hopital::where('id',$hopitalservice->hopital_id)->first();
        $hopitalservice->fill([
            'lits' => $request['lits'],
        ])->save();

        return redirect::to('/administration/hopital/'.$hopital->id)->with('message', 'Modifié avec succes');

    }

    public function destroyservice($id)
    {
        DB::table('hopital_service')->where('id', $id)->delete();
        return Redirect::back()->with('message', 'Supprimé avec succes');
    }


    public function storeadmin(Request $request)
    {

        $user =  User::create([
            'nom' => request('nom'),
            'prenom' => request('prenom'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
        ]);


        User::find($user->id)->roles()->attach(2 , ['post_id' => $request->get('id')]);


        return Redirect::back()->with('message', 'Ajouté avec succes');
    }


    public function editadmin(User $user)
    {
        return view('hopital.admin.edit', ['user'=>$user]);
    }


    public function destroyadmin($id)
    {
        DB::table('hopital_service')->where('id', $id)->delete();
        return Redirect::back()->with('message', 'Supprimé avec succes');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Hopital::destroy($id);
        return redirect::to('/administration/hopital/')->with('message', 'supprime avec succés');

    }


    public function getHopitalsData()
    {

        $hopitals = Hopital::select(['id', 'type', 'designation', 'wilaya', 'tel', 'email']);

        return Datatables::of($hopitals)
            ->addColumn('action', function ($hopital) {
                return '<a href="/administration/hopital/'. $hopital->id . '/" class="btn btn-xs btn-primary" >Visioner</a>
                <a href="/administration/hopital/'. $hopital->id . '/edit" class="btn btn-xs btn-warning" >Modifier</a>
                <a href="/administration/hopital/'. $hopital->id . '/destroy" class="btn btn-xs btn-danger">Supprimer</a>';

            })
            ->make(true);
    }



    public function getServicesData($id)
    {

        $services = Hopital::find($id)->services();

        return Datatables::of($services)->removeColumn('hopital_id','service_id','created_at','updated_at')
            ->addColumn('action', function ($service) {
                return '<a href="/administration/hopital/services/'. $service->id . '/edit" class="btn btn-xs btn-warning" >Modifier</a>
                <a href="/administration/hopital/services/'. $service->id . '/destroy" class="btn btn-xs btn-danger">Supprimer</a>';

            })            ->make(true);
    }


    public function getAdminData($id)
    {

        $users = Role::find(2)->users()->where('post_id',$id);

        return Datatables::of($users)->removeColumn('role_id','user_id','post_id')
            ->addColumn('action', function ($user) {
                return '<a href="/administration/admin/'. $user->id . '/edit" class="btn btn-xs btn-warning" >Modifier</a>
                <a href="/administration/admin/'. $user->id . '/destroy" class="btn btn-xs btn-danger">Supprimer</a>';

            })            ->make(true);
    }

}
