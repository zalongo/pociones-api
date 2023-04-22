<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Potion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
    ];


    /**
     * The ingredients that belong to the Potion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_potions')->withPivot('quantity');
    }


    public function scopeList($query, int $limit, int $page)
    {
        $offset = ($page - 1) * $limit;
        $query->limit($limit)
            ->offset($offset)
            ->orderBy('name', 'ASC');
    }
}
