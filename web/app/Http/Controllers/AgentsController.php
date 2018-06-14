<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentsController extends Controller
{



    public function store(Request $request)
    {

        Station::find($request->id)->agents()->create([
            'matricule' => request('matricule'),
            'nom' => request('nom'),
            'prenom' => request('prenom'),
            'email' => request('email'),
            'telephone' => request('telephone'),
            'sexe' => request('sexe'),
            'adresse' => request('adresse'),
            'date_n' => request('date_n'),
            'lieu_n' => request('lieu_n'),
            'grade' => request('grade'),
        ]);


        return Redirect::back()->with('message', 'Ajouté avec succes');
    }

}
