<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    /** @use HasFactory<\Database\Factories\PlanFactory> */
    use HasFactory;

    protected $fillable = ['product_id', 'name', 'duration_months', 'price'];

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function subscriptions(): HasMany {
        return $this->hasMany(Subscription::class);
    }

    public function listPlanFeatures(): HasMany {
        return $this->hasMany(ListPlanFeature::class);
    }

    public function transactions(): HasMany {
        return $this->hasMany(Transaction::class);
    }
}
