<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DailyRunGoal extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public $casts = [
        'is_finished' => 'boolean',
    ];

    //// リレーションエリア ////
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function dailyScores(): BelongsToMany
    {
        return $this->belongsToMany(DailyScore::class);
    }
}
