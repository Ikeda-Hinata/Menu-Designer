@extends('layouts.app')

@section('content')
 <form action="{{route('meals.store')}}" method="POST">
     @csrf
     <table>
            
                <tr>
                    <th></th>
                    <th>月曜日</th>
                    <th>火曜日</th>
                    <th>水曜日</th>
                    <th>木曜日</th>
                    <th>金曜日</th>
                    <th>土曜日</th>
                    <th>日曜日</th>
                </tr>
        
            <tbody>
                <tr>
                    <th>朝</th>
                    @for ($i = 0; $i < 7; $i++)
                        <td><input type="text" name="meals[{{$i}}][morning]" placeholder="朝食"></td>
                    @endfor
                </tr>
                <tr>
                    <th>昼</th>
                    @for ($i = 0; $i < 7; $i++)
                        <td><input type="text" name="meals[{{$i}}][afternoon]" placeholder="昼食"></td>
                    @endfor
                </tr>
                <tr>
                    <th>夜</th>
                    @for ($i = 0; $i < 7; $i++)
                        <td><input type="text" name="meals[{{$i}}][evening]" placeholder="夕食"></td>
                    @endfor
                </tr>
            </tbody>
        </table>
        <button type="submit">保存</button>
 </form>
@endsection