<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LongRunGoal extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $casts = [
        'schedule_on' => 'date',
    ];

    public function middleRunGoals(): HasMany
    {
        return $this->hasMany(MiddleRunGoal::class);
    }
}
