@extends('layouts.app')

@section('content')
<form action="{{route('recipes.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <h1>レシピの登録</h1>
    <h2>Title</h2>
    <input type="text" name="title" placeholder="レシピのタイトル">
    <input type="file" name="recipe-file">
    <p>
        <input type="text" name="category" placeholder="カテゴリー">
    </p>
    <p>
        <input type="text" name="description" placeholder="説明">
    </p>
    <!--材料を書く-->
    <div class="ingredients-information">
        <h1>材料</h1>
        <input type="number" name="number" placeholder="何人分">
        <p>人分</p>
        <div id="ingredients">
            <div class="ingredients-inputs">
                <input type="text" name="name[]" placeholder="食材">
                <input type="text" name="quantity[]" placeholder="量">
            </div>
        </div>
            <button id="ingredients-add" type="button">追加</button>
            <button id="ingredients-remove" type="button">削除</button>
    </div>
    <!--手順-->
        <div id="instructions">
            <div class="instructions-inputs">
                <input type="text" name="instructions_text[]" placeholder="手順">
                <input type="file" name="instructions_file[]" placeholder="ファイル" multiple>
            </div>
        </div>
            <button id="instructions-add" type="button">追加</button>
            <button id="instructions-remove" type="button">削除</button>
            <button type="submit">保存</button>
</form>

<script src="{{ asset('javascript/recipes.js') }}"></script>
@endsection