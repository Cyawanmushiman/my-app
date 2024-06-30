<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\MiddleRunGoalController\StoreRequest;
use App\Http\Requests\User\MiddleRunGoalController\UpdateRequest;
use App\Models\LongRunGoal;
use App\Models\MiddleRunGoal;
use Illuminate\Http\Request;

class MiddleRunGoalController extends Controller
{
    public function __construct(
        private MiddleRunGoal $middleRunGoal,
    ) {
    }

    /**
     * 一覧
     *
     * @return \Illuminate\View\View
     */
    public function index(LongRunGoal $longRunGoal)
    {
        return view('user.middle_run_goals.index', [
            'longRunGoal' => $longRunGoal,
            'middleRunGoals' => $longRunGoal->middleRunGoals->sortBy('finish_on'),
        ]);
    }

    /**
     * 登録フォーム表示
     *
     * @return \Illuminate\View\View
     */
    public function create(LongRunGoal $longRunGoal)
    {
        return view('user.middle_run_goals.create', [
            'longRunGoal' => $longRunGoal,
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
        MiddleRunGoal::create($request->substitutable());

        return to_route('user.middle_run_goals.index')->with('status', 'success create middle run goal');
    }

    /**
     * 編集フォーム表示
     *
     * @return \Illuminate\View\View
     */
    public function edit(MiddleRunGoal $middleRunGoal)
    {
        return view('user.middle_run_goals.edit', [
            'middleRunGoal' => $middleRunGoal,
            'longRunGoal' => $middleRunGoal->longRunGoal,
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
    public function update(MiddleRunGoal $middleRunGoal ,UpdateRequest $request)
    {
        $middleRunGoal->update($request->substitutable());

        return to_route('user.middle_run_goals.index')->with('status', 'success update middle run goal');
    }

    /**
     * 削除
     *
     * @param MiddleRunGoal $middleRunGoal
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(MiddleRunGoal $middleRunGoal, Request $request)
    {
        $middleRunGoal->delete();
        
        $longRunGoal = LongRunGoal::find($request->long_run_goal_id);
        return to_route('user.middle_run_goals.index', $longRunGoal)->with('status', 'success delete middle run goal');
    }
}
