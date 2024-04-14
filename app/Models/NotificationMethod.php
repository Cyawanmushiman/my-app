<?php

namespace App\Models;

use Notification;
use App\Enums\NotificationMethodType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificationMethod extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    protected $casts = [
        'method' => NotificationMethodType::class,
    ];
    
    ////////////// リレーション↓ //////////////
    public function notificationSetting(): BelongsTo
    {
        return $this->belongsTo(NotificationSetting::class);
    }
    ////////////// リレーション↑ //////////////
}
