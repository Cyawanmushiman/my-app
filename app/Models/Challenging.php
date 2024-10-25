<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Challenging extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    protected $casts = [
        'archived_on' => 'date',
    ];
    
    const FIGHTING = 10;
    const WIN = 20;
    const LOSE = 30;
    
    const FIGHTING_STATUS = [
        self::FIGHTING => 'fighting',
        self::WIN => 'win',
        self::LOSE => 'lose',
    ];
    
    // リレーションエリア↓
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function opponent(): BelongsTo
    {
        return $this->belongsTo(Opponent::class);
    }
    
    public function challengingOpponentInfo(): HasOne
    {
        return $this->hasOne(ChallengingOpponentInfo::class);
    }
    
    public function challengingLogs(): HasMany
    {
        return $this->hasMany(ChallengingLog::class);
    }
    
    public function userChallengeAbility(): HasOne
    {
        return $this->hasOne(UserChallengeAbility::class);
    }
}
