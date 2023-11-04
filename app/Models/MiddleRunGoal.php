<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MiddleRunGoal extends Model
{
    use HasFactory;

    protected $guarded = [];

    /////// リレーションエリア　////////
    public function longRunGoal(): BelongsTo
    {
        return $this->belongsTo(LongRunGoal::class);
    }
}
