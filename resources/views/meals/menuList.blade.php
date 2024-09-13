@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/menuList.css')}}">
    <h1>Menu Gallery</h1>

    @if ($paginatedMenus->isEmpty())
        <p>献立がありません。</p>
    @else
        <div class="menu-cards">
    @foreach ($paginatedMenus as $menu)
        <div class="menu-card">
            <h2>{{ $menu->menuTitle }}</h2>
            <p>{{ $menu->overview }}</p>
            <a href="{{ route('meals.menuDetail', ['id' => $menu->id]) }}">
                <button>詳細を見る</button>
            </a>
        </div>
    @endforeach
        </div>


        <!-- ページネーション -->
        <div class="pagination">
            {{ $paginatedMenus->links() }}
        </div>
    @endif
@endsection
