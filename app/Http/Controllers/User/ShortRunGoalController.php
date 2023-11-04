<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ShortRunGoalController\StoreRequest;
use App\Http\Requests\User\ShortRunGoalController\UpdateRequest;
use App\Models\MiddleRunGoal;
use App\Models\ShortRunGoal;
use Illuminate\Http\Request;

class ShortRunGoalController extends Controller
{
    public function __construct(private ShortRunGoal $shortRunGoal)
    {
    }

    /**
     * 一覧
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $shortRunGoals = auth()->user()->shortRunGoals()->get();
        // 中期目標でグループ化
        $groupedShortRunGoals = $shortRunGoals->groupBy(function ($shortRunGoal) {
            /** @var \App\Models\ShortRunGoal $shortRunGoal */
            return $shortRunGoal->middleRunGoal->title;
        });
        
        return view('user.short_run_goals.index', [
            'groupedShortRunGoals' => $groupedShortRunGoals,
        ]);
    }

    /**
     * 登録フォーム表示
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {   
        $allLongRunGoals = auth()->user()->longRunGoals()->get();

        $allMiddleRunGoals = auth()->user()->middleRunGoals()->get();
        
        return view('user.short_run_goals.create', [
            'allLongRunGoals' => $allLongRunGoals,
            'allMiddleRunGoals' => $allMiddleRunGoals,
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
        $this->shortRunGoal->fill($request->substitutable())->save();

        return to_route('user.short_run_goals.index')->with('status', '作成しました');
    }

    /**
     * 編集フォーム表示
     *
     * @return \Illuminate\View\View
     */
    public function edit(ShortRunGoal $shortRunGoal)
    {
        $allLongRunGoals = auth()->user()->longRunGoals()->get();

        $allMiddleRunGoals = auth()->user()->middleRunGoals()->get();

        return view('user.short_run_goals.edit', [
            'allLongRunGoals' => $allLongRunGoals,
            'allMiddleRunGoals' => $allMiddleRunGoals,
            'shortRunGoal' => $shortRunGoal,
        ]);
    }

    /**
     * 更新
     *
     * @param UpdateRequest $request
     * @param ShortRunGoal $shortRunGoal
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, ShortRunGoal $shortRunGoal)
    {
        $shortRunGoal->fill($request->substitutable())->save();

        return back()->with('status', '更新しました');
    }

    /**
     * 削除
     *
     * @param ShortRunGoal $shortRunGoal
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(ShortRunGoal $shortRunGoal)
    {
        $shortRunGoal->delete();

        return to_route('user.short_run_goals.index')->with('status', '削除しました');
    }
}