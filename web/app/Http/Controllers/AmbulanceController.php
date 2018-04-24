<?php

namespace App\Http\Controllers;

use Auth;
use App\Ambulance;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;


class AmbulanceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()

    {
        $ambulaces = Ambulance::orderBy('created_at','desc')->simplePaginate(10);
        return view('ambulance.index', ['ambulances'=>$ambulaces]);
    }


    public function create()
    {
        return view('ambulance.create');
    }


    public function store(Request $request)
    {

        Ambulance::create([
            'matricule' => request('matricule'),
        ]);

        return Redirect::back()->with('message', 'Ajouté avec succes');
    }



}
