<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reason extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    // リレーションエリア↓
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
