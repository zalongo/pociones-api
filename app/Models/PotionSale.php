<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PotionSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'potion_id',
        'sale_id',
        'quantity',
        'total',
    ];
}
