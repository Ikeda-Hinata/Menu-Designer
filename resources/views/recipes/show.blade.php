@extends('layouts.app')

@section('content')
<h1>保存できました</h1>
    <h2>{{$newRecipe->title}}</h2>
    <img src="{{$newRecipe->image}}" alt="{{$newRecipe->title}}">
    <p>{{$newRecipe->description}}</p>
    
    <!-- 材料を書く -->
    <div class="ingredients-information">
        <h1>材料</h1>
        <p>{{$newRecipe->number}}人分</p>
        <div id="ingredients">
            @foreach($newIngredient as $ingredient)
                <div class="ingredients-inputs">
                    <p>{{ $ingredient->name }}</p>
                    <div>{{ $ingredient->quantity }}</div>
                </div>
            @endforeach
        </div>
    </div>
    
    <!-- 手順を書く -->
    <div id="instructions">
        @foreach($newInstruction as $instruction)
            <div class="instructions-inputs">
                @if($instruction->instructions_file)
                    <img src="{{ $instruction->instructions_file }}" alt="Instruction Image">
                @endif
                <p>{{ $instruction->instructions_text }}</p>
            </div>
        @endforeach
    </div>
@endsection
