@extends('layouts.app')

@section('title', $article->exists ? 'Editing ' . $article->title : 'Create new article')

@section('content')
  {!! Form::model($article, [
    'method' => $article->exists ? 'put' : 'post',
    'route' => $article->exists ? ['article.update', $article->id] : ['article.store'],
    'files' => true
  ]) !!}

  <div class="form-group">
    {!! Form::label('Заголовок') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
  </div>

  <div class="form-group">
    {!! Form::label('Текст') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
  </div>

  <div class="form-group">
    {!! Form::label('Изображение') !!}
    {!! Form::file('img', null, ['class' => 'form-control']) !!}
  </div>

  

  {!! Form::submit($article->exists ? 'Сохранить изменения' : 'Создать новую статью', ['class' => 'btn btn-primary']) !!}
@endsection