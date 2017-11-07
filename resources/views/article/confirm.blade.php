@extends('layouts.app')

@section('title', 'Удалить ' . $article->title)

@section('content')
  {!! Form::model($article, ['method' => 'delete', 'route' => ['article.destroy', $article->id]]) !!}
  
  <div class="alert alert-danger">
    <strong>Вы уверенны, что хотите удалить эту статью? Это действие нельзя отменить</strong>
  </div>
  
  {!! Form::submit('Да, удалить статью', ['class' => 'btn btn-danger']) !!}

  <a href="{{ route('article.index') }}" class="btn btn-success">
  <strong>Вернуться назад</strong>
  </a>
  
  {!! Form::close() !!}
@endsection