<?php

namespace App\Services;

use App\Models\DailyScore;

class HomeService
{
    public function store(array $dailyRunGoalIds, string $diary = null): void
    {
        // ユーザーのインスパイア回数を更新
        auth()->user()->increment('inspire_count');
        
        $allDailyRunGoals = auth()->user()->dailyRunGoals->pluck('id')->count();
        $archiveDailyRunGoals = count($dailyRunGoalIds);
        $score = round($archiveDailyRunGoals / $allDailyRunGoals * 100);
        // 今日の点数を登録
        $dailyScore = DailyScore::create([
            'user_id' => auth()->id(),
            'diary' => $diary,
            'score' => $score,
        ]);

        // 今日の点数に紐づく今日の目標を登録
        $dailyScore->dailyRunGoals()->attach($dailyRunGoalIds);
    }
}