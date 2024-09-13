@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="{{ asset('css/recipeList.css')}}">

<h1>Recipe Library</h1>
<div class="recipe-card-group">
    @foreach($recipes as $recipe)
    <div class="recipe-card">
        <!-- 画像 -->
        <a href="{{ route('recipes.recipeDetail', $recipe->id) }}">
            <img class="recipe-card__imgframe" src="{{ $recipe->image }}" alt="{{ $recipe->title }}">
        </a>
        <!-- タイトル・説明文 -->
        <div class="recipe-card__textbox">
            <div class="recipe-card__titletext">{{ $recipe->title }}</div>
            <div class="recipe-card__overviewtext">
                <li>Category: {{ $recipe->category }}</li>
                <li>Overview:{{ $recipe->description }}</li>
                <li>User: {{ $recipe->user->name }}</li>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- ページネーション -->
<div class="pagination">
    {{ $recipes->links() }}
</div>

@endsection
