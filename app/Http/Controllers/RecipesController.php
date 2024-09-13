<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\Instruction;
use App\Models\Comment;
use Cloudinary;

class RecipesController extends Controller
{
    public function create(){
        $user_id = Auth::id();
        return view('recipes.create',compact('user_id'));
    }
    public function store(Request $request){
        //レシピ
        $recipe_image_url = Cloudinary::upload($request->file('recipe-file')->getRealPath())->getSecurePath();
        $newRecipe = new Recipe();
        $newRecipe->user_id = auth()->id();
        $newRecipe->title = $request['title'];
        $newRecipe->category = $request->input('category');
        $newRecipe->number = $request->input('number');
        $newRecipe->image = $recipe_image_url;
        $newRecipe->description = $request->input('description');
        $newRecipe->save();
        
        //材料
        $names = $request->input('name');
        $quantities = $request->input('quantity');
        foreach ($names as $index => $name) {
        $newIngredient = new Ingredient();
        $newIngredient->recipe_id = $newRecipe->id;
        $newIngredient->name = $name;
        $newIngredient->quantity = $quantities[$index];
        $newIngredient->save();
        };
            
        //手順
        $instructionFiles = $request->file('instructions_file');
        $instructionTexts = $request->input('instructions_text');
        foreach ($instructionTexts as $index => $text) {
            $newInstruction = new Instruction();
            $newInstruction->recipe_id = $newRecipe->id;
            $newInstruction->instructions_text = $text;
            
            // ファイルが存在する場合のみアップロードと保存を行う
            if (isset($instructionFiles[$index])) {
                $fileUrl = Cloudinary::upload($instructionFiles[$index]->getRealPath())->getSecurePath();
                $newInstruction->instructions_file = $fileUrl;
            }
        
            $newInstruction->save();
        }
      return view('recipes.show')->with([
          'newRecipe' => $newRecipe,
          'newIngredient' => Ingredient::where('recipe_id', $newRecipe->id)->get(),
          'newInstruction' =>Instruction::where('recipe_id', $newRecipe->id)->get()
          ]);
    }
    public function recipeList(){
        $recipes = Recipe::where('user_id', Auth::id())->with('user')->paginate(9);
        return view('recipes.recipeList', compact('recipes'));
    }

    public function recipeDetail($id){
        $recipe = Recipe::findOrFail($id);
        $ingredients = Ingredient::where('recipe_id', $id)->get();
        $instructions = Instruction::where('recipe_id', $id)->get();
        $comments = Comment::where('recipe_id', $id)->get();
        return view('recipes.recipeDetail', compact('recipe', 'ingredients', 'instructions','comments'));
    }
    public function storeComment(Request $request, $recipeId){
        Comment::create([
            'recipe_id' => $recipeId,
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('recipes.recipeDetail', $recipeId);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');

        $recipes = Recipe::where('title', 'LIKE', "%{$search}%")
            ->orWhere('category', 'LIKE', "%{$search}%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('recipes.recipeList', compact('recipes'));
    }
}