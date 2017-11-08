<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $comments;
    
    public function __construct(Comment $comments)
    {        
        $this->comments = $comments;
    }

    public function index()
    {
        $comments = $this->comments;
        
        return view('welcome')->with('comments', $comments);
    }

    public function store(Request $request)
    {
        $comment = new Comment([
            'body' => $request->get('body'),
            'article_id' => $request->get('article_id')
        ]);

        if (!empty(auth()->user()->id)) {
            $comment->author_id = auth()->user()->id;
        } else {
            $comment->author_id = '0';
        }
        
        $comment->save();

        return view('welcome');
    }

}
