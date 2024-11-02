<?php

namespace App\Http\Controllers\User;

use App\Models\MindMap;
use Illuminate\View\View;
use App\Models\DailyScore;
use App\Util\GoalProgress;
use App\Models\Challenging;
use App\Services\HomeService;
use App\Models\ChallengingLog;
use App\Services\DailyScoreService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\User\HomeController\StoreRequest;

class HomeController extends Controller
{
    public function __construct(
        private HomeService $homeService,
        private DailyScoreService $dailyScoreService
    )
    {
        $this->homeService = $homeService;
        $this->dailyScoreService = $dailyScoreService;
    }

    // TOPページの表示、または初期目標設定画面へのリダイレクト
    public function home(): View|RedirectResponse
    { 
        if (auth()->user()->isFinishedSetUp() === false) {
            return to_route('user.set_ups.create_first_goal');
        }
        
        $goals = auth()->user()->dailyRunGoals->map(function($goal) {
            return [
                'id' => $goal->id,
                'title' => $goal->title,
                'is_finished' => (bool) $goal->is_finished,
            ];
        });
        
        // 今日すでに挑戦している場合は、そのログを取得
        $todayChallengingLogId = null;
        $challenging = auth()->user()->challengings()
                        ->where('result_status', Challenging::FIGHTING)
                        ->orWhere('archived_on', now()->startOfDay()->format('Y-m-d'))
                        ->first();
        
        if ($challenging) {  
            $todayChallengingLogId = $challenging->challengingLogs->where('created_at', '>=', now()->startOfDay())->first()?->id;
        }
        
        return view('user.home', [
            'gpData' => GoalProgress::getGoalProgressData(auth()->user()->purpose),
            'goals' => $goals,
            'reason' => auth()->user()->reason,
            'tip' => auth()->user()->tip,
            'reward' => auth()->user()->reward,
            'isNotChallenging' => auth()->user()->isNotChallenging(),
            'latestDailyScore' => DailyScore::where('user_id', auth()->id())->latest()->first(),
            'todayChallengingLogId' => $todayChallengingLogId,
        ]);
    }

    public function store(StoreRequest $request): RedirectResponse
    {        
        \DB::transaction(function () use ($request) {
            $this->homeService->store($request->daily_run_goal_ids, $request->diary);
        });

        return to_route('user.home.show_good_job');
    }

    public function showGoodJob(): View
    {
        $user = auth()->user();
        $inspireCount = $user->inspire_count;
        $userInspires = $user->inspires;
        
        if ($userInspires->count() > 0) {
            // 循環カウント
            $index = $inspireCount % \count($userInspires);
            $inspire = $userInspires[$index];
        }
        
        return view('user.good_job', [
            'consecutiveDays' => $this->dailyScoreService->getConsecutiveDays(),
            'dailyScores' => $user->dailyScores,
            'inspire' => $inspire ?? null,
        ]);
    }
}