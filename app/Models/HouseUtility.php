<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseUtility extends Model
{
    use HasFactory;

    protected $table = 'house_utilities';

    protected $fillable = [
        'name',
    ];

    public function utility() {
        return $this->belongsTo(Utility::class);
    }
}
