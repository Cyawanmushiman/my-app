<?php

namespace App\Services;

use App\Models\DailyScore;

class HomeService
{
    public function store(array $dailyRunGoalIds): void
    {
        // ユーザーのインスパイア回数を更新
        auth()->user()->increment('inspire_count');
        
        $allDailyRunGoals = auth()->user()->dailyRunGoals->pluck('id')->count();
        $archiveDailyRunGoals = count($dailyRunGoalIds);
        $score = round($archiveDailyRunGoals / $allDailyRunGoals * 100);
        // 今日の点数を登録
        $dailyScore = DailyScore::create([
            'score' => $score,
            'user_id' => auth()->id(),
        ]);

        // 今日の点数に紐づく今日の目標を登録
        $dailyScore->dailyRunGoals()->attach($dailyRunGoalIds);
    }
}