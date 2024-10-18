<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Challenging extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
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
}
