<?php

namespace App\Http\Controllers;

use App\Intervention;
use App\Rapport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RapportsController extends Controller
{

    public function store(Request $request)
    {

        Intervention::find($request->id)->rapports()->create([
            'body' => request('body'),
        ]);

        return redirect::back()->with('message', 'Ajouté avec succes');

    }

    public function destroy($id)
    {
        $rapport= Rapport::findOrFail($id);
        $rapport->delete();
        return redirect::back()->with('message', 'Supprimer avec success');
    }

}
