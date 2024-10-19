<?php

namespace App\Http\Controllers\User;

use Illuminate\View\View;
use App\Models\DailyScore;
use Illuminate\Http\Request;
use App\Services\HomeService;
use App\Models\ChallengingLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Services\ChallengingLogService;
use App\Http\Requests\User\ChallengingLogController\StoreRequest;

class ChallengingLogController extends Controller
{
    public function __construct(
        private HomeService $homeService,
        private ChallengingLogService $challengingLogService
    )
    {
        $this->homeService = $homeService;
        $this->challengingLogService = $challengingLogService;
    }
    
    /**
     * store the specified resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $challengingLog = \DB::transaction(function () use ($request) {            
            $challengingLog = $this->challengingLogService->store($request->daily_run_goal_ids);
            
            $this->homeService->store($request->daily_run_goal_ids);
            
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
        $resultOpHitPoint = $currentOpHitPoint - $thisDamageToOp; // このターン後のHP
        
        // 勇者の情報
        $maxUserHitPoint = $challenging->user->userAbility->hit_point; // 勇者の最大HP
        $totalUserDamage = $challenging->challengingLogs->where('id', '!=', $challengingLogId)->sum('un_archive_count'); // これまでのダメージをサマリー
        $currentUserHitPoint = $maxUserHitPoint - $totalUserDamage; // 現在のHP
        $currentUserHitPointPercentage = $currentUserHitPoint === 0 ? 0 : round($currentUserHitPoint / $maxUserHitPoint * 100); // 現在のHPの%
        $thisDamageToUser = $latestChallengingLog->un_archive_count; // このターンで受けたダメージ
        $resultUserHitPoint = $currentUserHitPoint - $thisDamageToUser; // このターン後のHP
        
        return view('user.challenging_logs.display_battle', [
            'latestChallengingLog' => $latestChallengingLog,
            'challenging' => $challenging,
            
            'maxOpHitPoint' => $maxOpHitPoint,
            'currentOpHitPoint' => $currentOpHitPoint,
            'currentOpHitPointPercentage' => $currentOpHitPointPercentage,
            'thisDamageToOp' => $thisDamageToOp,
            'resultOpHitPoint' => $resultOpHitPoint,
            
            'maxUserHitPoint' => $maxUserHitPoint,
            'currentUserHitPoint' => $currentUserHitPoint,
            'currentUserHitPointPercentage' => $currentUserHitPointPercentage,
            'thisDamageToUser' => $thisDamageToUser,
            'resultUserHitPoint' => $resultUserHitPoint,
        ]);
    }

}
