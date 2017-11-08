<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

        <style>
            h2 {
                font-family: 'Playfair Display', serif;
                margin-bottom: 30px;
            }
            .article-wrap {
                border: 1px solid #ccc;
                padding: 10px;
                margin-bottom: 20px;
            }
            .article-wrap img {
                max-width: 90%;
            }
            .comment-wrap {
                margin-left: 20px;
                padding-left: 10px;
                border-left: 2px solid #000;                 
            }
            .comment-area {
                height: 90px !important;
            }
            h4 {
                margin-bottom: 10px;
            }
            .links {
                margin-top: 25px;
                text-align: right;
            }
            .links a {
                margin-left: 10px;
            }
        </style>

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <h2 class="text-center">BLOGOSFERA</h2>
                </div>                
                
                <div class="col-md-4">
                    @if (Route::has('login'))
                        <div class="top-right links">
                            @auth
                                <a href="{{ url('/dashboard/article') }}">Панель управления</a>
                            @else
                                <a href="{{ route('login') }}">Вход</a>
                                <a href="{{ route('register') }}">Регистрация</a>
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
        

        <div class="container">
            
            
            @foreach($articles as $article)
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="article-wrap">
                        <h3><strong>{{ $article->title }}</strong></h3>
                        <span>{{ date('d.m.Y', strtotime($article->created_at)) }}</span>
                        @if ($article->img)
                            <img src="{{ $article->img }}" />
                        @endif   
                        <p>{{ $article->body }}</p>                        
                    </div>
                    <div class="comments-wrap">                        
                        @foreach($comments as $comment)
                            @if ($comment->article_id == $article->id)                                
                            <div class="comment-wrap">
                                <span>{{ date('d.m.Y', strtotime($article->created_at)) }}</span>
                                <p>{{ $comment->body }}</p>
                            </div>
                            <br>
                            @endif                            
                        @endforeach                        
                        
                        {!! Form::open(['route' => ['comment.store', $article->id]]) !!}
                        {!! Form::hidden('article_id', $article->id) !!}
                        <div class="form-group">                        
                            {!! Form::textarea('body', null, ['class' => 'form-control comment-area']) !!}
                        </div>
                        {!! Form::submit('Отправить', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <br>              
            @endforeach                
            
            <div class="row">
                <div class="text-center">{{$articles->links()}}</div>
            </div>
        </div>
    </body>
</html>
