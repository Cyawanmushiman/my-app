<?php

namespace App\Models;

use App\Enums\DayOfWeek;
use App\Enums\NotificationMethodType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificationSetting extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    protected $casts = [
        'day_of_the_week' => DayOfWeek::class,
        'action_time' => 'datetime',
        'is_enable' => 'boolean',
    ];
    
    public function isSendEmail(): bool
    {
        return $this->notificationMethods->contains('method', NotificationMethodType::Email);
    }
    
    public function isSendLine(): bool
    {
        return $this->notificationMethods->contains('method', NotificationMethodType::Line);
    }
    
    ////////////// リレーション↓ //////////////
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function notificationMethods(): HasMany
    {
        return $this->hasMany(NotificationMethod::class);
    }
    ////////////// リレーション↑ //////////////
}
