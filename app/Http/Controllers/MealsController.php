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
        $meals = $request->input('meals', []);  // デフォルトを設定

        // メニューを先に保存
        $menu = new Menu();
        $menu->user_id = $user_id;
        $menu->menuTitle = $request->input('menuTitle');
        $menu->overview = $request->input('overview');
        $menu->is_shared = $request->input('is_shared');
        $menu->save();

        $dayOfWeekIni = ['月', '火', '水', '木', '金', '土', '日'];

        foreach ($meals as $dayIndex => $meal) {
            $day = $dayOfWeekIni[$dayIndex] ?? null;
            if ($day === null) continue;  // 異常データの防止

            foreach ($meal as $meal_time => $titles) {
                $mealModel = new Meals();
                $mealModel->user_id = $user_id;
                $mealModel->menu_id = $menu->id;
                $mealModel->day_of_week = $day;
                $mealModel->meal_time = $meal_time;
                $mealModel->save();

                foreach ($titles as $title) {
                    $food = new Food();
                    $food->meal_id = $mealModel->id;
                    $food->title = $title;
                    $food->save();
                }
            }
        }

        return redirect()->route('meals.show');
    }

    public function show(){
        $mealData = Meals::where('user_id', auth()->id())
            ->with('foods')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(['day_of_week', 'meal_time'])
            ->map(function ($mealsByTime) {
                return $mealsByTime->map(function ($meals) {
                    return $meals->first();
                });
            });

        $menu = Menu::where('user_id', auth()->id())->latest()->first();

        return view('meals.show', compact('mealData', 'menu'));
    }

    public function menuList()
    {
        $userId = auth()->id();
        $paginatedMenus = Menu::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        $userName = auth()->user()->name;

        return view('meals.menuList', compact('paginatedMenus', 'userName'));
    }

    public function menuDetail($id)
    {
        $userName = auth()->user()->name;
        $menu = Menu::find($id);

        if (!$menu) {
            return redirect()->route('meals.menuList')->with('error', 'メニューが見つかりません。');
        }

        $paginatedMenus = Meals::where('menu_id', $id)->with('foods')->paginate(21);

        return view('meals.menuDetail', compact('userName', 'menu', 'paginatedMenus'));
    }
}
