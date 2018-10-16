@extends('layouts.app')
@section('content')
        <div class="flex-center position-ref full-height">

            <div class="content-laravelwelcome">
                <div class="title m-b-md">
                    Articles Page
                </div>
                <hr>
                <h3>Articles</h3>
                @foreach ($articles as $article)
                    <p>{{ $article->title }} | ID: {{ $article->category_id }}</br>
                    <small>Category: </small>{{ $article->category->title }}</p>
                    <br>
                @endforeach
                {{$articles->links()}}
            </div>
        </div>
        <img class="big-mofo-img" src="/img/retroshrine-compressed.jpg" alt="">
@endsection
