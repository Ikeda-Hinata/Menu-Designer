<?php

namespace App\Http\Controllers;

use App\Models\Meals;
use Illuminate\Http\Request;

class MealsController extends Controller
{
     public function index() {
        return view('meals.index');
    }
    public function create(){
        $dayOfWeek = ['月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日', '日曜日'];
        $mealTime = ['朝', '昼', '夜'];
        return view('meals.create', compact('dayOfWeek', 'mealTime'));
    }


    public function store(Request $request, Meals $meals){
        $meals = $request->input('meals');//空のmealインスタンスにmealsというキーを持つものを入れる
        $daysOfWeek = ['月', '火', '水', '木', '金', '土', '日'];
    
        // meal 配列をループして、それぞれをデータベースに保存
        foreach ($meals as $dayIndex => $meal) {//morning,afternoon,eveningを繰り返し処理
            foreach ($meal as $meal_time => $title) {
                // 新しい Meal インスタンスを作成
                $newMeal = new Meals();
    
                // 曜日を取得
                $day = $daysOfWeek[$dayIndex];
               
                // 各要素をモデルのプロパティに割り当てる
                $newMeal->meal_time = $meal_time;  // "morning", "afternoon", "evening"
                $newMeal->day_of_week = $day;              // "月", "火", "水", ...
                $newMeal->user_id = auth()->id();  // 現在のユーザーのIDを保存
    
                // データベースに保存
                $newMeal->save();
            }
        }
        return redirect()->back()->with('success', '保存に成功しました.');
    }
}
