<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestViewHouse extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'request_view_houses';

    protected $fillable = [
        'user_id',
        'house_id',
        'view_time',
        'status', // 1:pending 2:approved 3:rejected 4:deleted 5: canceled
        'tenant_message',
        'rent_message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public static function getRentRequestViewHouse($user_id)
    {
        return self::where('user_id', $user_id)
            ->whereNull('deleted_at')
            ->get();
    }

    public static function getTenantRequestViewHouse($user_id)
    {
        return self::where('user_id', '!=', $user_id)
            ->whereNull('deleted_at')
            ->get();
    }
}
