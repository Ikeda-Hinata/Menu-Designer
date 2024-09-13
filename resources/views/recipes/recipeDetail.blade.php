@extends('layouts.app')

@section('content')
<div>
    <h1>メニュー名:{{ $recipe->title }}</h1>
    <h1>カテゴリー:{{ $recipe->category}}</h1>
    <img src="{{ $recipe->image }}">
    <p>{{ $recipe->description }}</p>

    <h3>材料</h3>
    <ul>
        @foreach($ingredients as $ingredient)
        <li>{{ $ingredient->name }}: {{ $ingredient->quantity }}</li>
        @endforeach
    </ul>

    <h3>手順</h3>
    @foreach($instructions as $instruction)
        <p>{{ $instruction->instructions_text }}</p>
        @if($instruction->instructions_file)
            <img src="{{ $instruction->instructions_file }}">
        @endif
    @endforeach

    <h3>コメント</h3>
    <ul>
        @foreach($comments as $comment)
        <li>
            <strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}
        </li>
        @endforeach
    </ul>

    @auth
    <form action="{{ route('recipes.storeComment', $recipe->id) }}" method="POST">
        @csrf
        <textarea name="content" placeholder="コメントを入力..." rows="4" required></textarea>
        <button type="submit">コメントする</button>
    </form>
    @endauth

    <a href="{{ route('recipes.recipeList') }}">戻る</a>
</div>
@endsection
