<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_id',
        'url',
    ];

    /**
     * Relationships
     */

    // 1 house - n images
    public function house() {
        return $this->belongsTo(House::class, 'house_id', 'id');
    }

    /**
     * Accessors
     */
    protected function url(): Attribute {
        return Attribute::make(
            get: fn ($url) => asset(str_replace('\\', '/', $url))
        );
    }
}
