<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChallengingLog extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    // リレーションエリア↓
    public function challenging(): BelongsTo
    {
        return $this->belongsTo(Challenging::class);
    }
}
