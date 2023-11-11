<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Contracts\Database\Eloquent\Builder;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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
    ];

    //////// リレーションエリア ////////
    public function longRunGoals(): HasMany
    {
        return $this->hasMany(LongRunGoal::class);
    }

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
}
