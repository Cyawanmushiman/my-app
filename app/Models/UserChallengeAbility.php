<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserChallengeAbility extends Model
{
    use HasFactory;

    protected $guarded = [];

    // リレーションエリア↓
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function challenging(): BelongsTo
    {
        return $this->belongsTo(Challenging::class);
    }
}
