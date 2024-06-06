<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'title',
        'address',
        'street',
        'ward',
        'district',
        'price',
        'land_area',
        'type',
        'view_number',
        'description',
        'bedroom_num',
        'bathroom_num',
        'latitude',
        'longitude',
        'status', // 1: empty 2: rent 3: hidden 4: lock 
        'deleted_by',
    ];

    /**
     * Relationships
     */

    // 1 user - n posts
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // 1 post - n images
    public function images() {
        return $this->hasMany(Image::class, 'post_id', 'id');
    }

    // 1 post - n videos
    public function videos() {
        return $this->hasMany(Video::class, 'post_id', 'id');
    }

    // 1 post - n reviews
    public function reviews() {
        return $this->hasMany(Review::class);
    }

    // 1 post - n houseutilities
    public function houseUtilities() {
        return $this->hasMany(HouseUtility::class,'house_id', 'id');
    }

    // n posts - n users
    public function bookmarkedBy()
    {
        return $this->belongsToMany(User::class, 'bookmarks', 'post_id', 'user_id');
    }

    public function scopeComparePrice($query, $priceMin, $priceMax ) {
        if($priceMin && $priceMax) return $query->whereBetween('price',  [$priceMin, $priceMax]);
        if(!$priceMin && $priceMax) return $query->where('price', '<', $priceMax);
        if(!$priceMax && $priceMin) return $query->where('price', '>', $priceMin);
    }

    public function scopeCompareArea($query, $areaMin, $areaMax ) {
        if($areaMin && $areaMax) return $query->whereBetween('land_area',  [$areaMin, $areaMax]);
        if(!$areaMin && $areaMax) return $query->where('land_area', '<', $areaMax);
        if(!$areaMax && $areaMin) return $query->where('land_area', '>', $areaMin);
    }

    public static function getRentHouse($user_id){
        return self::where('user_id', $user_id)
        ->get();
    }
}
