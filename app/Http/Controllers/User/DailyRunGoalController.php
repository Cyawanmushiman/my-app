<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\DailyRunGoalController\StoreRequest;
use App\Http\Requests\User\DailyRunGoalController\UpdateRequest;
use App\Models\DailyRunGoal;
use Illuminate\Http\Request;

class DailyRunGoalController extends Controller
{
    /**
     * 一覧
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('user.daily_run_goals.index', [
            'allDailyRunGoals' => DailyRunGoal::all(),
        ]);
    }

    /**
     * 登録フォーム表示
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {        
        return view('user.daily_run_goals.create');
    }

    /**
     * 登録
     *
     * @param StoreRequest $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $params = array_merge($request->substitutable(), [
            'user_id' => auth()->id(),
        ]);
        DailyRunGoal::create($params);

        return to_route('user.daily_run_goals.index')->with('status', '作成しました');
    }

    /**
     * 編集フォーム表示
     *
     * @return \Illuminate\View\View
     */
    public function edit(DailyRunGoal $dailyRunGoal)
    {
        return view('user.daily_run_goals.edit', [
            'dailyRunGoal' => $dailyRunGoal,
        ]);
    }

    /**
     * 更新
     *
     * @param UpdateRequest $request
     * @param DailyRunGoal $dailyRunGoal
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, DailyRunGoal $dailyRunGoal)
    {
        $dailyRunGoal->fill($request->substitutable())->save();

        return back()->with('status', '更新しました');
    }

    /**
     * 削除
     *
     * @param DailyRunGoal $dailyRunGoal
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DailyRunGoal $dailyRunGoal)
    {
        $dailyRunGoal->delete();

        return to_route('user.daily_run_goals.index')->with('status', '削除しました');
    }
}