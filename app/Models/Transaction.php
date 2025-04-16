<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'plan_id', 'license_key', 'start_date', 'end_date', 'is_active', 'merchant_ref', 'reference', 'amount', 'status', 'payment_url'];

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
