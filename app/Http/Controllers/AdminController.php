<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(!Gate::allows('isAdmin')){
        return redirect('/');
      } else {
        return view('admin.dashboard');
      }
    }
    public function categories()
    {
        return view('admin.categories');
    }
}
