<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IngredientPotion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
            'potion_id',
            'ingredient_id',
            'quantity',
        ];
}