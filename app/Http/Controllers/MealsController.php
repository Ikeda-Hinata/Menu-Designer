<?php

namespace App\Http\Controllers;

use App\Models\Meals;
use App\Models\Food;
use App\Models\Menu;
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


    public function store(Request $request)
{

    $user_id = auth()->id();

    // メニューを先に保存
    $menu = new Menu();
    $menu->user_id = $user_id;
    $menu->menuTitle = $request->input('menuTitle');
    $menu->overview = $request->input('overview');
    $menu->is_shared = $request->input('is_shared');
    $menu->save();

    // meal の保存処理
    $meals = $request->input('meals');
    $dayOfWeekIni = ['月', '火', '水', '木', '金', '土', '日'];

    foreach ($meals as $dayIndex => $meal) {
        $day = $dayOfWeekIni[$dayIndex];

        foreach ($meal as $meal_time => $titles) {
            $meal = new Meals();
            $meal->user_id = $user_id;
            $meal->menu_id = $menu->id;  // ここで関連する menu_id を設定
            $meal->day_of_week = $day;
            $meal->meal_time = $meal_time;
            $meal->save();

            foreach ($titles as $title) {
                $food = new Food();
                $food->meal_id = $meal->id;
                $food->title = $title;
                $food->save();
            }
        }
    }

    return redirect()->route('meals.show');
}

    public function show(){
        $mealData = Meals::where('user_id', auth()->id())//現在認証されているユーザーのIDでMealsモデルのデータを取得
        ->with('foods')
        ->orderBy('created_at', 'desc')
        ->get()
        ->groupBy(['day_of_week', 'meal_time']) // 曜日と食事時間でグループ化
        ->map(function ($mealsByTime) {
            return $mealsByTime->map(function ($meals) {
                return $meals->first(); // 各曜日と食事時間の最新の献立を取得
            });
        })
        ->flatten(); // コレクションをフラットに変換
        
        $menu = Menu::where('user_id', auth()->id())->latest()->first();
        return view('meals.show',compact('mealData','menu'));
        
    }
    public function menuList()
{
    $userId = auth()->id();
    // ページネーションを適用してメニューを取得
    $paginatedMenus = Menu::where('user_id', $userId)
        ->orderBy('created_at', 'desc')
        ->paginate(9); // 1ページあたり10件のメニューを表示

    $userName = auth()->user()->name;

    return view('meals.menuList', compact('paginatedMenus', 'userName'));
}

    public function menuDetail($id){
        $userName = auth()->user()->name;
        $menu = Menu::findOrFail($id);
        $paginatedMenus = Meals::where('menu_id', $id)->with('foods')->paginate(21);
        return view('meals.menuDetail', compact('userName', 'menu', 'paginatedMenus'));
}
}
