@extends('layouts.app')

@section('content')
    @if(empty($menu->menuTitle))
        <h1>献立はありません。</h1>
    @else
        <h1>作成者:{{ $userName }}</h1>
        <h1>タイトル:{{ $menu->menuTitle }}</h1>
        <h1>概要:{{ $menu->overview }}</h1>
        
        <a href="{{ route('meals.menuDetail', ['id' => $menu->id]) }}"><button>詳細を見る</button></a>
    @endif
    <!-- ページネーション -->
    <div class="pagination">
        {{ $paginatedMenus->links() }}
    </div>
@endsection
