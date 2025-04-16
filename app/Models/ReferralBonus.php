<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralBonus extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'referred_user_id', 'amount', 'is_claimed', 'claimed_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function referredUser()
    {
        return $this->belongsTo(User::class, 'referred_user_id');
    }
}
