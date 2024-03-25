<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utility extends Model
{
    use HasFactory;

    protected $table = 'utilities';

    protected $fillable = [
        'name',
    ];

    public function house_utilities() {
        return $this->hasMany(HouseUtility::class, 'utility_id', 'id');
    }
}
