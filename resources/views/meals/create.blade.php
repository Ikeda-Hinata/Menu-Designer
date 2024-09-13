@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/menuCreate.css')}}">

<div class="form-container">
    <form action="{{ route('meals.store') }}" method="POST">
        @csrf
        
        <div>
            <input type="text" name="menuTitle" placeholder="タイトル">
            <input type="text" name="overview" placeholder="概要">
        </div>
        <table>
            <tbody>
                @php
                    $days = ['月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日', '日曜日'];
                    $meals = ['morning' => '朝', 'afternoon' => '昼', 'evening' => '夜'];
                @endphp

                @for ($i = 0; $i < 7; $i++)
                    <tr>
                        <th>{{ $days[$i] }}</th>
                        <td></td>
                    </tr>
                    @foreach ($meals as $key => $meal)
                    <tr>
                        <td>{{ $meal }}</td>
                        <td>
                            <input type="text" name="meals[{{ $i }}][{{ $key }}][]" placeholder="{{ $meal }}食">
                            <button class="add" type="button">アイテムを追加</button>
                            <button class="remove" type="button">アイテムを削除</button>
                        </td>
                    </tr>
                    @endforeach
                @endfor
            </tbody>
        </table>
        <div>
            <label>保存か共有か選んでください:</label>
            
            <div>
                <input type="radio" id="save" name="is_shared" value="0" checked>
                <label for="save">マイ献立として保存</label>
            </div>
            <div>
                <input type="radio" id="share" name="is_shared" value="1">
                <label for="share">みんなとシェアする</label>
            </div>
      
        </div>
        <button type="submit">保存</button> 
    </form>
</div>

<script src="{{asset('javascript/meals.js')}}"></script>
@endsection
