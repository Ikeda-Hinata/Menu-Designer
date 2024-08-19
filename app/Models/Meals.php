<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meals extends Model
{
    use HasFactory;
    
   protected $fillable=[
        'user_id',
        'day',
        'morning',
        'afternoon',
        'evening',
        ];
}
