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
    public function homepage()
    {
        $articles = Article::orderBy('created_at','desc')->take(5)->get();
        return view('pages.home-page')->withArticles($articles);
    }
}
