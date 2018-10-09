<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Gate;

class HomeController extends Controller
{

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
    public function api()
    {
        return view('admin.api');
    }
    public function homepage()
    {
        $articles = Article::orderBy('id', 'desc')->paginate(10);
        return view('welcome')->withArticles($articles);
    }
}
