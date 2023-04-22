<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
    ];

    protected $appends = ['criticalStock'];

    public function getCriticalStockAttribute()
    {
        return $this->stock <= 10;
    }

    public function scopeList($query, int $limit, int $page)
    {
        $offset = ($page - 1) * $limit;
        $query->limit($limit)
            ->offset($offset)
            ->orderBy('name', 'ASC');
    }
}
