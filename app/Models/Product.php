<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = ['name', 'desc'];

    public function plans(): HasMany {
        return $this->hasMany(Plan::class);
    }

    public function subscriptions(): HasMany {
        return $this->hasMany(Subscription::class);
    }

    public function transactions(): HasMany {
        return $this->hasMany(Transaction::class);
    }
}
