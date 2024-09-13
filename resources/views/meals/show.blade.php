@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/menuShow.css')}}">
<div class ="menuShow">
    <h1>{{ $menu->menuTitle }}</h1>
    <h1>{{ $menu->overview }}</h1>
    <table>
        <thead>
            <tr>
                <th>曜日</th>
                <th>時間</th>
                <th>メニュー</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mealData as $mealShow)
                <tr>
                    <td>{{ $mealShow->day_of_week }}</td>
                    <td>{{ $mealShow->meal_time }}</td>
                    <td>
                        @foreach($mealShow->foods as $food)
                            {{ $food->title }}
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection