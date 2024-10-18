<?php

namespace App\Http\Controllers\User;

use Illuminate\View\View;
use App\Models\DailyScore;
use Illuminate\Http\Request;
use App\Models\ChallengingLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\User\ChallengingLogController\StoreRequest;

class ChallengingLogController extends Controller
{
    /**
     * store the specified resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $challengingLog = \DB::transaction(function () use ($request) {
            // 達成できた目標の数
            $archivedCount= count($request->daily_run_goal_ids);
            // 達成できなかった目標の数
            $unArchivedCount = auth()->user()->dailyRunGoals()->count() - $archivedCount;
            
            // challengingLogsテーブルにを作成
            $challengingLog = ChallengingLog::create([
                'challenging_id' => auth()->user()->challenging->id,
                'archive_count' => $archivedCount,
                'un_archive_count' => $unArchivedCount,
            ]);
            
            
            $allDailyRunGoals = auth()->user()->dailyRunGoals->pluck('id')->count();
            $archiveDailyRunGoals = count($request->daily_run_goal_ids);
            $score = round($archiveDailyRunGoals / $allDailyRunGoals * 100);
            
            $params = array_merge($request->substitutable(), [
                'score' => $score,
                'user_id' => auth()->id(),
            ]);
    
            // ユーザーのインスパイア回数を更新
            auth()->user()->increment('inspire_count');
            
            // // 今日の点数を登録
            $dailyScore = DailyScore::create($params);
    
            // // 今日の点数に紐づく今日の目標を登録
            $dailyRunGoalIds = $request['daily_run_goal_ids'];
            $dailyScore->dailyRunGoals()->attach($dailyRunGoalIds);
            
            return $challengingLog;
        });
        
        return to_route('user.challenging_logs.display_battle', $challengingLog->id);
    }
    
    public function displayBattle(int $challengingLogId): View
    {
        $latestChallengingLog = ChallengingLog::findOrFail($challengingLogId);
        $challenging = $latestChallengingLog->challenging->load(['challengingOpponentInfo', 'challengingLogs', 'user', 'user.userAbility']);
        
        // 敵の情報
        $maxOpHitPoint = $challenging->challengingOpponentInfo->max_hit_point; // 敵の最大HP
        $totalOpDamage = $challenging->challengingLogs->where('id', '!=', $challengingLogId)->sum('archive_count'); // これまでのダメージをサマリー
        $currentOpHitPoint = $maxOpHitPoint - $totalOpDamage; // 現在のHP
        $currentOpHitPointPercentage = $currentOpHitPoint === 0 ? 0 : round($currentOpHitPoint / $maxOpHitPoint * 100); // 現在のHPの%
        $thisDamageToOp = $latestChallengingLog->archive_count; // このターンで与えたダメージ
        
        // 勇者の情報
        $maxUserHitPoint = $challenging->user->userAbility->hit_point; // 勇者の最大HP
        $totalUserDamage = $challenging->challengingLogs->where('id', '!=', $challengingLogId)->sum('un_archive_count'); // これまでのダメージをサマリー
        $currentUserHitPoint = $maxUserHitPoint - $totalUserDamage; // 現在のHP
        $currentUserHitPointPercentage = $currentUserHitPoint === 0 ? 0 : round($currentUserHitPoint / $maxUserHitPoint * 100); // 現在のHPの%
        $thisDamageToUser = $latestChallengingLog->un_archive_count; // このターンで受けたダメージ
        
        return view('user.challenging_logs.display_battle', [
            'latestChallengingLog' => $latestChallengingLog,
            'challenging' => $challenging,
            
            'maxOpHitPoint' => $maxOpHitPoint,
            'currentOpHitPoint' => $currentOpHitPoint,
            'currentOpHitPointPercentage' => $currentOpHitPointPercentage,
            'thisDamageToOp' => $thisDamageToOp,
            
            'maxUserHitPoint' => $maxUserHitPoint,
            'currentUserHitPoint' => $currentUserHitPoint,
            'currentUserHitPointPercentage' => $currentUserHitPointPercentage,
            'thisDamageToUser' => $thisDamageToUser,
        ]);
    }

}
