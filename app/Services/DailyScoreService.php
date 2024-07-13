<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\DailyScore;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class DailyScoreService
{
    // 連続登録日数を取得する
    public function getConsecutiveDays(): int
    {
        // 最新の今日の目標を取得
        $dailyScores = DailyScore::orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d'); // 日付でグループ化
            });

        $consecutiveDays = 0;
        $previousDate = null;
        foreach ($dailyScores as $date => $scores) {
            $currentDate = Carbon::createFromFormat('Y-m-d', $date);

            if ($previousDate === null) {
                $previousDate = $currentDate;
                $consecutiveDays = 1;
            } else {
                // 前日の日付に設定する
                $previousDate->subDay();

                if ($previousDate->equalTo($currentDate)) {
                    $consecutiveDays++;
                } else {
                    break; // 日付が連続していない場合はループを終了
                }

                // 次のループのために日付を更新
                $previousDate = $currentDate;
            }
        }

        return $consecutiveDays;
    }
    
    public static function search(array $params): Builder
    {
        $query = DailyScore::with(['dailyRunGoals'])
            ->where('user_id', auth()->id())
            ->latest();
            
        if ($params['search_diary']) {
            $query->where('diary', 'like', "%{$params['search_diary']}%");
        }
        
        return $query;
    }
}
