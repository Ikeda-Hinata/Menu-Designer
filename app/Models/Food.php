<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    
    protected $table = 'foods'; // テーブル名を明示的に指定
    protected $fillable = [
        'meal_id',
        'title'
        ];
        
     public function meal()
    {
        return $this->belongsTo(Meals::class, 'meal_id');
    }
}
