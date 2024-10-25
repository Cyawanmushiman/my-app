<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChallengingOpponentInfo extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    // リレーションエリア↓
    public function challenging(): BelongsTo
    {
        return $this->belongsTo(ChallengingLog::class);
    }   
}
