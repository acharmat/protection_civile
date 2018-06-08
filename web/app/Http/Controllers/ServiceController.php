<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;


use App\Hopital;


class ServiceController extends Controller
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
        return view('service.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('service.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Service::create([
            'designation' => request('designation'),
        ]);

        return Redirect::back()->with('message', 'Ajouté avec succes');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('service.edit')->with('service', $service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $service = Service::find($request->id);
        $service->fill([
            'designation' => $request['designation'],
        ])->save();

        return redirect::to('/administration/services/')->with('message', 'Modifié avec succes');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Service::destroy($id);
        return redirect::to('/administration/services/')->with('message', 'supprime avec succés');

    }


    public function getServiceData()
    {

        $services = Service::select(['id',  'designation']);

        return Datatables::of($services)
            ->addColumn('action', function ($service) {
                return '
                <a href="/administration/services/'. $service->id . '/edit"  class="btn btn-xs btn-warning" >Modifier</a>
                <a href="/administration/services/'. $service->id . '/destroy" class="btn btn-xs btn-danger">Supprimer</a>';

            })
            ->make(true);
    }


}
