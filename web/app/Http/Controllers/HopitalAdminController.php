<?php

namespace App\Http\Controllers;

use App\Hopital;
use Illuminate\Http\Request;

class HopitalAdminController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Role_HopitalAdmin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('HopitalAdmin.index');
    }


}
