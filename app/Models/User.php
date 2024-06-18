<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
        'address',
        'cccd_number',
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

    // 1 user - n posts
    public function posts() {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    // 1 user - n reviews
    public function reviews() {
        return $this->hasMany(Review::class);
    }

    // n users -like- n reviews
    public function likedReviews() {
        return $this->belongsToMany(Review::class, 'review_likes')->withTimestamps();
    }

    // n users - n posts
    public function bookmarks()
    {
        return $this->belongsToMany(Post::class, 'bookmarks', 'user_id', 'post_id');
    }

    protected function avatar(): Attribute {
        return Attribute::make(
            //Format URL cho ảnh (thêm địa chỉ base url serve)
            get: fn ($avatar) =>  $avatar ? asset(str_replace('\\', '/', 'storage/'.$avatar)) : null,
        );
    }
}
