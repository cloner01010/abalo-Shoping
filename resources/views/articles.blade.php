<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>articles</title>
    <link rel="stylesheet" href="{{ asset('storage/css/cookiecheck.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/css/articles.css') }}">
    <script src="https://kit.fontawesome.com/87db36f807.js" crossorigin="anonymous"></script>
    <script src="{{asset('storage/js/articles.js')}}" defer></script>
</head>
<body>
@extends("cookiecheck")
@section("cookie-popup")
    @parent
@endsection
@include('header')
<main>
    <table id="articles-table">
        <tr id="header-table">
            <th></th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Creator</th>
            <th>Created at</th>
        </tr>
        @foreach($articles as $article)
            @isset($article)
                <tr>
                    <th><img class="article-image" src="{{ asset($article->ab_file_path)}}" alt="Artikel"></th>
                    <th>{{$article->ab_name}}</th>
                    <th>{{$article->ab_price}}€</th>
                    <th>{{$article->ab_description}}</th>
                    <th>{{$article->user_name}}</th>
                    <th>{{$article->ab_createdate}}</th>
                    <th><button class="btn"><i id="{{$article->id}}" class="add-btn fa-solid fa-circle-plus fa-lg"></i></button></th>
                </tr>
            @endisset
        @endforeach

    </table>
</main>

</body>
</html>
