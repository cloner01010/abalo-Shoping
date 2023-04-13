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
<img class="logo" src="{{asset('storage/logo.png')}}" alt="nopic">
<header class="header-container">
    <div class="logout">
        <form method="get" action={{route('logout')}}>
            <button class="btn" type="submit" value="Logout"><i class="fa-solid fa-right-from-bracket fa-lg"></i></button>
        </form>
    </div>
    <div class="shopping-cart">
        <button class="btn"><i onclick="showCart()" class="shopping-cart-btn fa-solid fa-cart-shopping fa-lg"></i></button>
    </div>
    <div class="amount">
        <p class="amount-text"></p>
    </div>
   <div id="cart-container" class="cart-container">
       <table id="cart-table">
           <tr class="cart-header">
               <th></th>
               <th>Name</th>
               <th>Price</th>
               <th>Creator</th>
           </tr>
       </table>
   </div>
    <div>
        <form method="get" action={{route('articles')}}>
            <input type="search" name="search" class="question" id="nme" required autocomplete="off" value="{{ request('search') }}"/>
            <label for="nme"><span>Search</span></label>
            <button class="search-button btn" type="submit" value="search"><i class="fa-brands fa-searchengin fa-xl"></i></button>

        </form>
    </div>

</header>
<main>
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
                    <th><img class="article-image" src="{{ asset('storage/articleimages/'.$article->img)}}" alt="Artikel"></th>
                    <th>{{$article->ab_name}}</th>
                    <th>{{$article->ab_price}}€</th>
                    <th>{{$article->ab_description}}</th>
                    <th>{{$article->user_name}}</th>
                    <th>{{$article->ab_createdate}}</th>
                    <th><button class="btn"><i class="add-btn fa-solid fa-circle-plus fa-lg"></i></button></th>
                </tr>
            @endisset
        @endforeach

    </table>
</main>

</body>
</html>
