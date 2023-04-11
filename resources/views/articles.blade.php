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

</head>
<body>
@extends("cookiecheck")
@section("cookie-popup")
    @parent
@endsection
<h1>Übersicht</h1>
<button class="btn"><i class="fa-solid fa-cart-shopping fa-lg"></i></button>
<form method="get" action={{route('logout')}}>
    <input class="btn" type="submit" value="Logout">
</form>
<form method="get" action={{route('articles')}}>
    <label for="search">Search: </label><br>
    <input type="search" placeholder="Find Articles here" name="search" value="{{ request('search') }}">
    <input class="btn" type="submit" value="search">
</form>

<table>
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Description</th>
        <th>Creator</th>
        <th>Created at</th>
    </tr>
    @foreach($articles as $article)
        @isset($article)
           <tr>
               <th>{{$article->id}}</th>
               <th><img src="{{ asset('storage/articleimages/'.$article->img)}}" alt="Artikel"></th>
               <th>{{$article->ab_name}}</th>
               <th>{{$article->ab_price}}€</th>
               <th>{{$article->ab_description}}</th>
               <th>{{$article->user_name}}</th>
               <th>{{$article->ab_createdate}}</th>
               <th><button class="btn"><i class="fa-solid fa-circle-plus fa-lg"></i></button></th>
           </tr>
        @endisset
    @endforeach

</table>
</body>
</html>
