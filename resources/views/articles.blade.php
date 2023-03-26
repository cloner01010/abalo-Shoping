<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>articles</title>
</head>
<body>
<h1>Übersicht</h1>
<form method="get" action={{route('logout')}}>
    <input type="submit" value="Logout">
</form>
<form method="get" action={{route('articles')}}>
    <label for="search">Search: </label><br>
    <input type="search" placeholder="Find Articles here" name="search" value="{{ request('search') }}">
    <input type="submit" value="search">
</form>
<table style="border-spacing: 30px;">
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
               <th><img style=" height: 120px; width: auto;" src="{{ asset('storage/articleimages/'.$article->img)}}" alt="Artikel"></th>
               <th>{{$article->ab_name}}</th>
               <th>{{$article->ab_price}}€</th>
               <th>{{$article->ab_description}}</th>
               <th>{{$article->user_name}}</th>
               <th>{{$article->ab_createdate}}</th>
           </tr>
        @endisset
    @endforeach
</table>
</body>
</html>
