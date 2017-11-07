<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    protected $articles;

    public function __construct(Article $articles)
    {
        //$this->middleware('guest');
        $this->articles = $articles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $articles = $this->articles->paginate(10);
        
        return view('welcome')->with('articles', $articles);        
        
    }
}