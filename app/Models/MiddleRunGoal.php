<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MiddleRunGoal extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $casts = [
        'schedule_on' => 'date',
    ];

    /////// リレーションエリア　////////
    public function longRunGoal(): BelongsTo
    {
        return $this->belongsTo(LongRunGoal::class);
    }

    public function shortRunGoals(): HasMany
    {
        return $this->hasMany(ShortRunGoal::class);
    }
}
