<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class SuperAdminController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Role_SuperAdmin');    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }


    public function store(Request $request)
    {

        $user =  User::create([
            'nom' => request('nom'),
            'prenom' => request('prenom'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
        ]);


        User::find($user->id)->roles()->attach(1);


        return Redirect::back()->with('message', 'Ajouté avec succes');
    }

    public function getAdminData()
    {

        $users = Role::find(1)->users();

        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return '
                <a href="/administration/hopital/'. $user->id . '/edit" class="btn btn-xs btn-warning" >Modifier</a>
                <a href="/administration/hopital/'. $user->id . '/destroy" class="btn btn-xs btn-danger">Supprimer</a>';

            })
            ->make(true);
    }

}
