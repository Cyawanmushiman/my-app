<?php

namespace App\Http\Controllers\User;

use Illuminate\View\View;
use App\Models\DailyScore;
use App\Models\Challenging;
use Illuminate\Http\Request;
use App\Services\HomeService;
use App\Models\ChallengingLog;
use App\Services\DailyScoreService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Services\ChallengingLogService;
use App\Http\Requests\User\ChallengingLogController\StoreRequest;

class ChallengingLogController extends Controller
{
    public function __construct(
        private HomeService $homeService,
        private ChallengingLogService $challengingLogService,
        private DailyScoreService $dailyScoreService
    ) {
        $this->homeService = $homeService;
        $this->challengingLogService = $challengingLogService;
        $this->dailyScoreService = $dailyScoreService;
    }

    /**
     * store the specified resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $challengingLog = \DB::transaction(function () use ($request) {
            $challengingLog = $this->challengingLogService->store($request->daily_run_goal_ids);

            $this->homeService->store($request->daily_run_goal_ids, $request->diary);
            
            // 敵を倒した場合、challengingテーブルを更新
            $opponentInfos = $this->challengingLogService->getOpponentInfo($challengingLog->id);
            if ($opponentInfos['resultOpHitPoint'] <= 0) {
                $challengingLog->challenging->update([
                    'result_status' => Challenging::WIN,
                    'archived_on' => now(),
                ]);
            }
            
            // 勇者が倒れた場合、challengingテーブルを更新
            $userInfos = $this->challengingLogService->getUserInfo($challengingLog->id);
            if ($userInfos['resultUserHitPoint'] <= 0) {
                $challengingLog->challenging->update([
                    'result_status' => Challenging::LOSE,
                    'archived_on' => now(),
                ]);
            }

            return $challengingLog;
        });

        return to_route('user.challenging_logs.display_battle', $challengingLog->id);
    }

    public function displayBattle(int $challengingLogId): View
    {
        $latestChallengingLog = ChallengingLog::findOrFail($challengingLogId);
        $challenging = $latestChallengingLog->challenging->load(['challengingOpponentInfo', 'challengingLogs', 'user', 'userChallengeAbility']);
        
        // 敵の情報
        $opponentInfos = $this->challengingLogService->getOpponentInfo($challengingLogId);

        // 勇者の情報
        $userInfos = $this->challengingLogService->getUserInfo($challengingLogId);

        return view('user.challenging_logs.display_battle', [
            'latestChallengingLog' => $latestChallengingLog,
            'challenging' => $challenging,

            'maxOpHitPoint' => $opponentInfos['maxOpHitPoint'],
            'currentOpHitPoint' => $opponentInfos['currentOpHitPoint'],
            'currentOpHitPointPercentage' => $opponentInfos['currentOpHitPointPercentage'],
            'thisDamageToOp' => $opponentInfos['thisDamageToOp'],
            'resultOpHitPoint' => $opponentInfos['resultOpHitPoint'],

            'maxUserHitPoint' => $userInfos['maxUserHitPoint'],
            'currentUserHitPoint' => $userInfos['currentUserHitPoint'],
            'currentUserHitPointPercentage' => $userInfos['currentUserHitPointPercentage'],
            'thisDamageToUser' => $userInfos['thisDamageToUser'],
            'resultUserHitPoint' => $userInfos['resultUserHitPoint'],
            
            'consecutiveDays' => $this->dailyScoreService->getConsecutiveDays(),
            'dailyScores' => auth()->user()->dailyScores,
        ]);
    }
}
