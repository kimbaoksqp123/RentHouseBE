<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestViewHouse extends Model
{
    use HasFactory;

    protected $table = 'request_view_houses';

    protected $fillable = [
        'user_id',
        'house_id',
        'view_time',
        'status', // 1:pending 2:approved 3:rejected 4:deleted
        'tenant_message',
        'rent_message'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function post() {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
