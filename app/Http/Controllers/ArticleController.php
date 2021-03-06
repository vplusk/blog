<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class ArticleController extends Controller
{
    protected $articles;

    public function __construct(Article $articles)
    {
        $this->middleware('auth');
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
        
        return view('article/index')->with('articles', $articles);        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Article $article)
    {         
        return view('article/form', compact('article'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {          
        $img = $request->file('img');
        $filename = $this->getFileName($img);        
        $img->move(base_path('public'), $filename);

        $this->articles->create(['author_id' => auth()->user()->id, 'img' => $filename] + $request->only('title', 'body'));
        

        return redirect(route('article.index'))->with('status', 'Статья успешно создана');
    }

    private function getFileName($file)
    {        
    	return str_random(32).'.'.$file->extension();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = $this->articles->findOrFail($id);
        
        return view('article.form', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateArticleRequest $request, $id)
    {
        $article = $this->articles->findOrFail($id);
        
        $filename = $this->getFileName($request->image);
    	$request->image->move(base_path('public'), $filename);
        
        $article->fill($request->only('title', 'body', 'img'))->save();
        return redirect(route('article.edit', $article->id))->with('status', 'Статья успешно изменена');
    }

    function confirm($id)
    {
        $article = $this->articles->findOrFail($id);
        
        return view('article.confirm', compact('article'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = $this->articles->findOrFail($id);

        $article->delete();

        return redirect(route('article.index'));
    }
}
