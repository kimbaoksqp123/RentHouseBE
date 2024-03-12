<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

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
        'status',

    ];

    /**
     * Relationships
     */

    // 1 user - n houses
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // 1 house - n images
    public function images() {
        return $this->hasMany(Image::class, 'house_id', 'id');
    }

    // 1 house - n videos
    public function videos() {
        return $this->hasMany(Video::class, 'house_id', 'id');
    }

    // 1 house - n reviews
    public function reviews() {
        return $this->hasMany(Review::class);
    }

    // n houses - n users
    public function bookmarkedBy()
    {
        return $this->belongsToMany(User::class, 'bookmarks', 'house_id', 'user_id');
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
}
