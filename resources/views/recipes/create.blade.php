@extends('layouts.app')

@section('content')
<form action="{{route('recipes.store')}}" method="POST">
    @csrf
    <h1>レシピの登録</h1>
    <h2>title</h2>
    <input type="text" name="title" placeholder="レシピのタイトル">
    <input type="file" name="file">
    <p></p>
    <!--材料を書く-->
    <div class="ingredients">
        <h1>材料</h1>
        <input type="number" name="number" placeholder="何人分">

    <div id="inputs">
        <!--フォームを追加-->
    </div>
    <button id="add" type="button">追加</button>
    <button id="remove" type="button">削除</button>
    </div>
    <!--手順を書く-->
    <div class="instructions">
    
    </div>
    
</form>
<script src="{{ asset('javascript/recipes.js') }}"></script>
@endsection