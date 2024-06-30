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
    
    // ランダムでサポートコメントを取得
    public static function getSupportComment(): string
    {
        $commentKey = array_rand(self::SUPPORT_COMMENTS);
        return self::SUPPORT_COMMENTS[$commentKey];
    }
    
    // 進捗バー用のデータを取得
    public static function getProgressData(Purpose $purpose)
    {
        // gif画像のurlをランダムで取得
        $gifImageUrl = self::getRandumGifImageUrl();

        // 長期目標の進捗率を取得
        $progressbarPerForLong = 0;
        if ($purpose->longRunGoal) {
            $progressbarPerForLong = self::getProgressPerForLong($purpose->longRunGoal);
        }

        // 中期目標の進捗バー用のデータを作成
        $middleGoalMap = [];
        if ($purpose->middleRunGoals) {
            $middleGoalMap = self::getMiddleGoalMapData($purpose);
        }
       
        return [
            'gifImageUrl' => $gifImageUrl,
            'progressbarPerForLong' => $progressbarPerForLong,
            'middleGoalMap' => $middleGoalMap,
        ];
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
    
    private static function getProgressPerForLong(LongRunGoal $longRunGoal)
    {
        // 最終日までの日数を取得
        $totalDayCount = $longRunGoal->start_on->diff($longRunGoal->finish_on)->days;
        $todayDayCount = $longRunGoal->start_on->diff(today())->days;
        // 座標を取得
        $progressbarPer = $todayDayCount / $totalDayCount * 100;
        
        return $progressbarPer;
    }
    
    // 進捗バー用のデータを取得
    private static function getMiddleGoalMapData(Purpose $purpose)
    {
        $middleGoalMap = [];
        foreach ($purpose->middleRunGoals as $middleRunGoal) {
            // 中期目標の座標を取得
            $middleProgressbarPer = self::getProgressPerForMiddle($purpose->longRunGoal, $middleRunGoal);

            // 進捗率と目標をマップに格納
            $middleGoalMap[$middleProgressbarPer] = $middleRunGoal->finish_on->format('Y/m/d') . "　" . $middleRunGoal->title;
        }
        
        return $middleGoalMap;
    }
    
    // 中期目標の進捗率を取得
    private static function getProgressPerForMiddle(LongRunGoal $longRunGoal, MiddleRunGoal $middleRunGoal)
    {
        // 最終日までの日数を取得
        $totalDayCount = $longRunGoal->start_on->diff($longRunGoal->finish_on)->days;
        $middleGoalCount = $longRunGoal->start_on->diff($middleRunGoal->finish_on)->days;
        // 進捗率を計算
        $middleProgressbarPer = $middleGoalCount / $totalDayCount * 100;
        
        return $middleProgressbarPer;
    }
}