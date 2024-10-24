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
    
    const FIGHTING = 10;
    const WIN = 20;
    const LOSE = 30;
    
    const FIGHTING_STATUS = [
        self::FIGHTING => '戦闘中',
        self::WIN => '勝利',
        self::LOSE => '敗北',
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
}
