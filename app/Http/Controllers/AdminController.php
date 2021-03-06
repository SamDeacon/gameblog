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
        return view('admin.dashboard');
    }
    public function categories()
    {
        return view('admin.categories');
    }
    public function users()
    {
        return view('admin.users');
    }
    public function developer()
    {
        return view('admin.developer');
    }
    public function profile()
    {
        return view('admin.profile');
    }
    public function consoles()
    {
        return view('admin.games.consoles');
    }
}
