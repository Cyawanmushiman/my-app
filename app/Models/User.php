<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Notifications\User\CustomVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'has_first_goal' => 'boolean',
        'is_mind_map_create' => 'boolean',
        'has_daily_goal' => 'boolean',
    ];

    public function isFinishedSetUp(): bool
    {
        return $this->has_first_goal && $this->is_mind_map_create && $this->has_daily_goal;
    }

    // メール確認マルチオースカスタム
    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail());
    }

    //////// リレーションエリア ////////
    public function purpose(): HasOne
    {
        return $this->hasOne(Purpose::class);
    }
    
    // public function longRunGoal(): HasOne
    // {
    //     return $this->hasOne(LongRunGoal::class);
    // }

    // ユーザーに関連する中期目標を取得する。
    public function middleRunGoals(): HasManyThrough
    {
        return $this->hasManyThrough(
            MiddleRunGoal::class,
            LongRunGoal::class,
            'user_id', // LongRunGoalの外部キー
            'long_run_goal_id', // MiddleRunGoalの外部キー
            'id', // Userのローカルキー
            'id' // LongRunGoalのローカルキー
        );
    }

    // ユーザーに関連する短期目標を取得する。
    public function shortRunGoals(): Builder
    {
        return ShortRunGoal::whereHas('middleRunGoal', function ($query) {
            $query->whereHas('longRunGoal', function ($subQuery) {
                $subQuery->where('user_id', $this->id);
            });
        });
    }

    // ユーザーに関連する今日の目標を取得する。
    public function dailyRunGoals(): HasMany
    {
        return $this->hasMany(DailyRunGoal::class);
    }

    // ユーザーに関連するインスパイアを取得する。
    public function inspires(): HasMany
    {
        return $this->hasMany(Inspire::class);
    }

    // daily_scoresテーブルとのリレーション
    public function dailyScores(): HasMany
    {
        return $this->hasMany(DailyScore::class);
    }
    
    // mind_mapsテーブルとのリレーション
    public function mindMaps(): HasMany
    {
        return $this->hasMany(MindMap::class);
    }
    
    // reasonsテーブルとのリレーション
    public function reason(): HasOne
    {
        return $this->hasOne(Reason::class);
    }
    
    // tipsテーブルとのリレーション
    public function tip(): HasOne
    {
        return $this->hasOne(Tip::class);
    }
    
    // rewardsテーブルとのリレーション
    public function reward(): HasOne
    {
        return $this->hasOne(Reward::class);
    }
    
    // user_abilitiesテーブルとのリレーション
    public function userAbility(): HasOne
    {
        return $this->hasOne(UserAbility::class);
    }
}
