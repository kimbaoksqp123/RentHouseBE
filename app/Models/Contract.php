<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'house_id',
        'start_date',
        'end_date',
        'file',
    ];

    /**
     * Relationship: 1 contract belongs to 1 post
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'house_id', 'id');
    }

    /**
     * Relationship: 1 contract belongs to 1 tenant user
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tenant_id', 'id');
    }
}
