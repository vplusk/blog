@extends('layouts.app')

@section('content')
<a href="{{ route('article.create') }}" class="btn btn-primary">Новая статья</a>
<table class="table table-hover">
  <thead>
    <tr>
      <th>Заголовок</th>
      <th>Автор</th>
      <th>Редактировать</th>
      <th>Удалить</th>
    </tr>
  </thead>  
  <tbody>
    @foreach($articles as $article)
      <tr>        
        <td>{{ $article->title }}</td>
        <td>{{ $article->author_id }}</td>
        <td><a href="{{ route('article.edit', $article->id) }}"><span class="glyphicon glyphicon-edit"></span></a></td>
        <td><a href="{{ route('article.confirm', $article->id) }}"><span class="glyphicon glyphicon-trash"></span></a></td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection