<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    </head>
    <body>
    <!--ヘッダー-->
    <header>
        <h1>
            <a href="/">Menu Designer</a>
        </h1>
        <nav>
            <form action="#" method="get">
                @csrf
                <input type="search" name="search" placeholder="献立、料理名、食材名">
                <input type="submit" name="submit" value="検索">
            </form>
            <ul>
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Sign up</a></li>
            </ul>
        </nav>
    </header>
    <!--メイン-->
    <main>
     @yield('content')
    </main>
    <!--フッター-->
    <footer>
        <p>SERVICE</p>
        <ul>
            <li><a href="{{route('meals.create')}}">献立作成</a></li>
            <li><a href="#">献立検索</a></li>
            <li><a href="{{route('recipes.create')}}">レシピ作成 </a></li>
            <li><a href="#">レシピ検索</a></li>
        </ul>
        <p>INFORMATION</p>
        <ul>
            <li><a href="#">お知らせ</a></li>
            <li><a href="#">お知らせ</a></li>
            <li><a href="#">お知らせ</a></li>
            <li><a href="#">お知らせ</a></li>
        </ul>
        <p>Copyright 2024 Hinata</p>
    </footer>
    </body>
</html>
