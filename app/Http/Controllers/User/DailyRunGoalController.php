<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\DailyRunGoalController\StoreRequest;
use App\Http\Requests\User\DailyRunGoalController\UpdateRequest;
use App\Models\DailyRunGoal;
use Illuminate\Http\Request;

class DailyRunGoalController extends Controller
{
    public function __construct(private DailyRunGoal $dailyRunGoal)
    {
    }

    /**
     * 一覧
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $dailyRunGoals = auth()->user()->dailyRunGoals()->get();
        $groupedDailyRunGoals = $dailyRunGoals->groupBy(function ($dailyRunGoal) {
            /** @var \App\Models\DailyRunGoal $dailyRunGoal */
            return $dailyRunGoal->shortRunGoal->title;
        });
        
        return view('user.daily_run_goals.index', [
            'groupedDailyRunGoals' => $groupedDailyRunGoals,
        ]);
    }

    /**
     * 登録フォーム表示
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {        
        return view('user.daily_run_goals.create',[
            'allLongRunGoals' => auth()->user()->longRunGoals()->get(),
            'allMiddleRunGoals' => auth()->user()->middleRunGoals()->get(),
            'allShortRunGoals' => auth()->user()->shortRunGoals()->get(),
        ]);
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
        $this->dailyRunGoal->fill($request->substitutable())->save();

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
            'allLongRunGoals' => auth()->user()->longRunGoals()->get(),
            'allMiddleRunGoals' => auth()->user()->middleRunGoals()->get(),
            'allShortRunGoals' => auth()->user()->shortRunGoals()->get(),
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