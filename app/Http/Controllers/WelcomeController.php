<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    protected $articles;
    protected $comments;

    public function __construct(Article $articles,Comment $comments)
    {
        //$this->middleware('guest');
        $this->articles = $articles;
        $this->comments = $comments;        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->articles->paginate(10);
        $comments = $this->comments->get();
        
        return view('welcome')->with('articles', $articles)->with('comments', $comments);
    }
}