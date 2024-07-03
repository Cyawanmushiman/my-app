<?php

namespace App\Util;

use Carbon\Carbon;
use App\Models\Purpose;
use App\Models\LongRunGoal;
use Illuminate\Http\Request;
use App\Models\MiddleRunGoal;
use Illuminate\Database\Eloquent\Builder;

class GoalProgress
{
    const GIF_IMAGE_NAMES = [
        'dark-human.gif',
        'cat-8915_128.gif',
        'walking-speed.gif',
    ];
    
    const SUPPORT_COMMENTS = [
        'なんか頑張れそうな気がする',
        '不本意だが今日だけがんばってみる',
        '今日が終わったら絶対に自分を褒めてあげたい',
        'このアプリを使っている時点でもう今日は素敵',
    ];
    
    // 進捗バー用のデータを取得
    public static function getGoalProgressData(?Purpose $purpose): array
    {
        // gif画像のurlをランダムで取得
        $gifImageUrl = self::getRandumGifImageUrl();

        // 長期目標の進捗率を取得
        $longRunGoal = $purpose->longRunGoal ?? null;
        $progressbarPerForLong = self::getProgressPerForLong($longRunGoal);

        // 中期目標の進捗バー用のデータを作成
        $middleGoalMap = self::getMiddleGoalMapData($purpose);
        
        // 次の目標までの残り日数を取得
        $nextGoalCount = self::getDayCountToNextGoal($purpose);
        
        // ショートレンジ進捗バー用のデータを作成
        $shortRangeData = self::shortRangeGoalProgress($purpose);
        
        return [
            'purpose' => $purpose,
            'longRunGoal' => $longRunGoal,
            'gifImageUrl' => $gifImageUrl,
            'progressbarPerForLong' => $progressbarPerForLong,
            'middleGoalMap' => $middleGoalMap,
            'nextGoalCount' => $nextGoalCount,
            'shortRangeData' => $shortRangeData,
        ];
    }
    
    // ランダムでサポートコメントを取得
    public static function getSupportComment(): string
    {
        $commentKey = array_rand(self::SUPPORT_COMMENTS);
        return self::SUPPORT_COMMENTS[$commentKey];
    }
    
    // ランダムでgif画像のurlを取得
    private static function getRandumGifImageUrl(): string
    {
        // ランダムでgifを取得
        $gifKey = array_rand(self::GIF_IMAGE_NAMES);
        // urlを取得
        $gifImageUrl = asset('images/gifs/' . self::GIF_IMAGE_NAMES[$gifKey]);
        
        return $gifImageUrl;
    }
    
    private static function getProgressPerForLong(?LongRunGoal $longRunGoal): float
    {
        $progressbarPer = 0;
        
        if ($longRunGoal) {
            // 最終日までの日数を取得
            $totalDayCount = $longRunGoal->start_on->diff($longRunGoal->finish_on)->days;
            $startFromTodayCount = $longRunGoal->start_on->diff(today())->days;
            // 座標を取得
            $progressbarPer = $startFromTodayCount / $totalDayCount * 100;
        }
        
        return $progressbarPer;
    }
    
    // 進捗バー用のデータを取得
    private static function getMiddleGoalMapData(?Purpose $purpose): array
    {
        $middleGoalMap = [];
        
        $middleRunGoals = $purpose->middleRunGoals ?? null;
        if ($middleRunGoals && $middleRunGoals->isNotEmpty()) {
            foreach ($purpose->middleRunGoals as $middleRunGoal) {
                // 中期目標の座標を取得
                $middleProgressbarPer = self::getProgressPerForMiddle($purpose->longRunGoal, $middleRunGoal);
    
                // 進捗率と目標をマップに格納
                $middleGoalMap[$middleProgressbarPer] = $middleRunGoal->finish_on->format('Y/m/d') . "　" . $middleRunGoal->title;
            }
        }
        
        return $middleGoalMap;
    }
    
    // 中期目標の進捗率を取得
    private static function getProgressPerForMiddle(LongRunGoal $longRunGoal, MiddleRunGoal $middleRunGoal): float
    {
        // 最終日までの日数を取得
        $totalDayCount = $longRunGoal->start_on->diff($longRunGoal->finish_on)->days;
        $middleGoalCount = $longRunGoal->start_on->diff($middleRunGoal->finish_on)->days;
        // 進捗率を計算
        $middleProgressbarPer = $middleGoalCount / $totalDayCount * 100;
        
        return $middleProgressbarPer;
    }

    // 次の目標までの残り日数を取得
    private static function getDayCountToNextGoal(?Purpose $purpose): int|null
    {
        $nextGoalCount = null;
        
        $longRunGoal = $purpose->longRunGoal ?? null;
        if ($longRunGoal) {
            $nextGoalCount = $longRunGoal->finish_on->diff(today())->days;
        }
        
        $middleRunGoals = $purpose->middleRunGoals ?? null;
        if ($middleRunGoals && $middleRunGoals->isNotEmpty()) {
            $nextGoalCount = $middleRunGoals->sortBy('finish_on')->first()->finish_on->diff(today())->days;
        }
        
        return $nextGoalCount;
    }
    
    private static function shortRangeGoalProgress(? Purpose $purpose): array
    {
        // 全ての目標を取得
        $longRunGoal = $purpose->longRunGoal ?? null;
        $middleRunGoals = $purpose->middleRunGoals ?? null;

        $allGoals = [];
        $shortRangeData = [];
        if ($middleRunGoals && $middleRunGoals->isNotEmpty()) {
            foreach ($middleRunGoals as $middleRunGoal) {
                $allGoals[$middleRunGoal->finish_on->format('Y/m/d')] = $middleRunGoal;
            }
            // dd($allGoals);
            $allGoals = array_merge($allGoals, [
                $longRunGoal->start_on->format('Y/m/d') => $longRunGoal,
                $longRunGoal->finish_on->format('Y/m/d') => $longRunGoal,
                today()->format('Y/m/d') => null,
            ]);
            
            // 日付順にソート
            ksort($allGoals);   
            dump($allGoals);
            // 今日の日付の前後の目標を取得
            $shortRangeData = [];
            $todayKey = today()->format('Y/m/d');
            $todayIndex = array_search($todayKey, array_keys($allGoals));
            $allGoals = array_values($allGoals);
            $shortRangeData['before'] = $allGoals[$todayIndex - 1] ?? null;
            $shortRangeData['after'] = $allGoals[$todayIndex + 1] ?? null;
        }
        
        return $shortRangeData;
    }
}