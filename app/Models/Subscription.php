<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    /** @use HasFactory<\Database\Factories\SubscriptionFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'plan_id', 'license_key', 'start_date', 'end_date', 'is_active', 'reference', 'merchant_ref', 'total_amount', 'status'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function plan(): BelongsTo {
        return $this->belongsTo(Plan::class, 'plan_id');
    }
}

