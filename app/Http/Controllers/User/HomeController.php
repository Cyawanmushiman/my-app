<?php

namespace App\Http\Controllers\User;

use App\Models\MindMap;
use Illuminate\View\View;
use App\Models\DailyScore;
use App\Services\DailyScoreService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\User\HomeController\StoreRequest;

class HomeController extends Controller
{
    // コンストラクタ
    public function __construct(private DailyScoreService $dailyScoreService)
    {
    }

    // TOPページの表示、または初期目標設定画面へのリダイレクト
    public function home(): View|RedirectResponse
    { 
        if (auth()->user()->isFinishedSetUp() === false) {
            return to_route('user.set_ups.create_first_goal');
        }
        
        return view('user.home');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $params = array_merge($request->substitutable(), [
            'user_id' => auth()->id(),
        ]);

        // ユーザーのインスパイア回数を更新
        auth()->user()->increment('inspire_count');

        // 今日の点数を登録
        $dailyScore = DailyScore::create($params);

        // 今日の点数に紐づく今日の目標を登録
        $dailyRunGoalIds = $request['daily_run_goal_ids'];
        $dailyScore->dailyRunGoals()->attach($dailyRunGoalIds);

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