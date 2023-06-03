<!DOCTYPE html>
<html lang="de" >
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <title>Abalo Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="{{ asset('storage/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/css/cookiecheck.css') }}">
</head>
<body>
@extends("cookiecheck")
@section("cookie-popup")
    @parent
@endsection
<div id="login-form-wrap">
    <img src="{{ asset('storage/logoabalo.JPG')}}" alt="">
    <h2>Login</h2>
    <form id="login-form" method="post" action={{route('login')}}>
        @csrf
        @isset($message)
           <p style="color: red">{{$message}}</p>
        @endisset
        <p>
            <input type="text" id="email" name="email" placeholder="Email Address" required><i class="validation"><span></span><span></span></i>
        </p>
        <p>
            <input type="password" id="username" name="password" placeholder="Password" required><i class="validation"><span></span><span></span></i>
        </p>
        <p>
            <input type="submit" id="login" value="Login">
        </p>
    </form>
    <div id="create-account-wrap">
        <p>Not a member? <a href="#">Create Account</a><p>
    </div><!--create-account-wrap-->
</div><!--login-form-wrap-->
<!-- partial -->
</body>
</html>
