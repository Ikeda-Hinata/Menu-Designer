<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meals extends Model
{
    use HasFactory;
    
   protected $fillable=[
        'user_id',
        'day_of_week',
        'morning',
        'afternoon',
        'evening',
        'recipe_id',//fk
        ];
        
    public function recipes(){
        return $this->belongsToMany(Recipes::class,'M-Rs');
    }
     public function foods()
    {
        return $this->hasMany(Food::class, 'meal_id');
    }
}
