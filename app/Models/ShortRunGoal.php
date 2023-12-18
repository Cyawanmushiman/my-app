<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShortRunGoal extends Model
{
    use HasFactory;

    protected $guarded = [];

    ////// リレーション定義 //////
    public function middleRunGoal(): BelongsTo
    {
        return $this->belongsTo(MiddleRunGoal::class);
    }
}
