<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'house_id',
        'content',
    ];

    /**
     * Relationships
     */

    // 1 house - n reviews
    public function house() {
        return $this->belongsTo(House::class);
    }

    // 1 user - n reviews
    public function user() {
        return $this->belongsTo(User::class);
    }

    // n users -like- n reviews
    public function likedUsers() {
        return $this->belongsToMany(User::class, 'review_likes')->withTimestamps();
    }
}
