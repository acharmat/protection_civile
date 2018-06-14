<?php

namespace App\Http\Controllers;

use App\Hopital;
use App\Intervention;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('HopitalAdmin.index');
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
                return '<a href="/administration/hopital/services/'. $intervention->id . '/edit" class="btn btn-xs btn-warning" >Modifier</a>
                <a href="/administration/hopital/'. $intervention->id . '/destroyservice" class="btn btn-xs btn-danger">Supprimer</a>';

            })            ->make(true);
    }



}
