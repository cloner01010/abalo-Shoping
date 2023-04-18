<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('storage/css/articles.css') }}">
</head>

<body>
    <div id="newarticle-main-container">
        <script src="{{ asset('storage/js/articles.js') }}"></script>
    </div>
</body>
</html>
