<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'url',
    ];

    /**
     * Relationships
     */

    // 1 post - n videos
    public function post() {
        return $this->belongsTo(Post::class, 'post_id', 'id');
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
