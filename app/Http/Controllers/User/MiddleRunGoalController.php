<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\MiddleRunGoalController\StoreRequest;
use App\Http\Requests\User\MiddleRunGoalController\UpdateRequest;
use App\Models\MiddleRunGoal;
use Illuminate\Http\Request;

class MiddleRunGoalController extends Controller
{
    public function __construct(
        private MiddleRunGoal $middleRunGoal,
    )
    {
        
    }

    /**
     * 一覧
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // 親テーブルでグループ化
        $groupedMiddleRunGoals = MiddleRunGoal::whereHas('longRunGoal', function ($query) {
            $query->where('user_id', auth()->guard('user')->id());
        })->get()->groupBy('long_run_goal_id');
        
        return view('user.middle_run_goals.index', [
            'allLongRunGoals' => auth()->guard('user')->user()->longRunGoals()->get(),
            'groupedMiddleRunGoals' => $groupedMiddleRunGoals,
        ]);
    }

    /**
     * 登録フォーム表示
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {        
        return view('user.middle_run_goals.create', [
            'allLongRunGoals' => auth()->guard('user')->user()->longRunGoals()->get(),
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
        $this->middleRunGoal->fill($request->substitutable())->save();

        return to_route('user.middle_run_goals.index')->with('status', '作成しました');
    }

    /**
     * 編集フォーム表示
     *
     * @return \Illuminate\View\View
     */
    public function edit(MiddleRunGoal $middleRunGoal)
    {
        return view('user.middle_run_goals.edit', [
            'allLongRunGoals' => auth()->guard('user')->user()->longRunGoals()->get(),
            'middleRunGoal' => $middleRunGoal,
        ]);
    }

    /**
     * 更新
     *
     * @param UpdateRequest $request
     * @param MiddleRunGoal $middleRunGoal
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, MiddleRunGoal $middleRunGoal)
    {
        $middleRunGoal->fill($request->substitutable())->save();

        return back()->with('status', '更新しました');
    }

    /**
     * 削除
     *
     * @param MiddleRunGoal $middleRunGoal
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(MiddleRunGoal $middleRunGoal)
    {
        $middleRunGoal->delete();

        return to_route('user.middle_run_goals.index')->with('status', '削除しました');
    }
}