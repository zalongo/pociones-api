<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email'
    ];

    /**
     * Get the sales informationthat owns the Client
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sales()
    {
        return $this->belongsTo(Sale::class);
    }





    public function scopeList($query, int $limit, int $page)
    {

        $offset = ($page - 1) * $limit;

        $query->offset($offset)
            ->limit($limit)
            ->orderBy('name', 'ASC');
    }
}
