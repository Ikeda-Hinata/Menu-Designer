<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;

class RecipesController extends Controller
{
    public function create(){
        $user_id = Auth::id();
        return view('recipes.create',compact('user_id'));
    }
    public function store(Request $request){
        $recipes = Recipe::all();
        return view('recipes.create')->with(['recipes',$recipes]);
    }
}
