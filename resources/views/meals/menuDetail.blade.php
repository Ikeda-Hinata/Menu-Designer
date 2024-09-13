@extends('layouts.app')

@section('content')
    <h1>作成者:{{ $userName }}</h1>
    <h1>タイトル:{{ $menu->menuTitle }}</h1>
    <h1>概要:{{ $menu->overview }}</h1>

    <table>
        <thead>
            <tr>
                <th>曜日</th>
                <th>時間</th>
                <th>メニュー</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paginatedMenus as $meal)
                <tr>
                    <td>{{ $meal->day_of_week }}</td>
                    <td>{{ $meal->meal_time }}</td>
                    <td>
                        @foreach ($meal->foods as $food)
                            {{ $food->title }}<br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
