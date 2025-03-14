<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberRequest extends Model
{
    use HasFactory;

    protected $table = 'member_requests';

    protected $fillable = [
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
