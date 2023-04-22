<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'total',
    ];

    /**
     * Get the client that owns the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the potion that owns the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function potions()
    {
        return $this->belongsToMany(Potion::class, 'potion_sales')->withPivot('quantity', 'total');
    }


    public function scopeList($query, int $limit, int $page)
    {
        $offset = ($page - 1) * $limit;
        $query->limit($limit)
            ->offset($offset)
            ->orderBy('id', 'DESC');
    }
}
