<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListPlanFeature extends Model
{
    use HasFactory;

    protected $fillable = ['plan_id', 'name', 'status'];

    public function plan(): BelongsTo {
        return $this->belongsTo(Plan::class, 'plan_id');
    }
}
