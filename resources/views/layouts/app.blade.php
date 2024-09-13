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
        <h1 id="title">
            <a href="/">Menu Designer</a>
        </h1>
        <nav>
            @csrf
            <form action="{{ route('recipes.search')}}" method="GET">
                <input type="text" name="search" value="{{request('search')}}" placeholder="料理名、カテゴリ">
                <button type="submit">検索</button>
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
        <h2>
        <ul id="footer">
            <li><a href="{{route('meals.create')}}">Menu Planning</a></li>
            <li><a href="{{route('meals.menuList')}}">Menu Gallery</a></li>
            <li><a href="{{route('recipes.create')}}">Recipe Creater </a></li>
            <li><a href="{{route('recipes.recipeList')}}">Recipe Library</a></li>
        </ul>
        </h2>
        <p id="right">© 2024 Hinata All Rights Reserved</p>
    </footer>
    </body>
</html>
