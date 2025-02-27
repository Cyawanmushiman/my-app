<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Purpose extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    /////// リレーションエリア ↓ //////
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function longRunGoal(): HasOne
    {
        return $this->hasOne(LongRunGoal::class);
    }
    
    public function middleRunGoals(): HasManyThrough
    {
        return $this->hasManyThrough(MiddleRunGoal::class, LongRunGoal::class);
    }
    ////// リレーションエリア ↑ //////
    
}
