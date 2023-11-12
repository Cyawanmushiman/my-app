<?php

namespace App\Http\Controllers\User;

use App\Models\DailyScore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\User\HomeController\StoreRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    /**
     * ホーム画面
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        return view('user.home');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $params = array_merge($request->substitutable(), [
            'user_id' => auth()->id(),
        ]);
        $dailyScore = DailyScore::create($params);
        $dailyRunGoalIds = $request['daily_run_goal_ids'];
        
        $dailyScore->dailyRunGoals()->attach($dailyRunGoalIds);

        return to_route('user.home')->with('status', '今日の目標を登録しました。');
    }
}