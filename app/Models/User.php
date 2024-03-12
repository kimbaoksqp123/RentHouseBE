<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'type',
        'name',
        'phone',
        'avatar',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relationships
     */

    // 1 user - n houses
    public function houses() {
        return $this->hasMany(House::class, 'user_id', 'id');
    }

    // 1 user - n reviews
    public function reviews() {
        return $this->hasMany(Review::class);
    }

    // n users -like- n reviews
    public function likedReviews() {
        return $this->belongsToMany(Review::class, 'review_likes')->withTimestamps();
    }

    // n users - n houses
    public function bookmarks()
    {
        return $this->belongsToMany(House::class, 'bookmarks', 'user_id', 'house_id');
    }
}
