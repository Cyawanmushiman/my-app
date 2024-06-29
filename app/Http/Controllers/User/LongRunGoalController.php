<?php

namespace App\Http\Controllers\User;

use App\Models\Purpose;
use App\Models\LongRunGoal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LongRunGoalController\StoreRequest;
use App\Http\Requests\User\LongRunGoalController\UpdateRequest;

class LongRunGoalController extends Controller
{
    /**
     * 一覧
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('user.long_run_goals.index', [
            'longRunGoals' => LongRunGoal::latest()->paginate(12),
        ]);
    }

    /**
     * 登録フォーム表示
     *
     * @return \Illuminate\View\View
     */
    public function create(Purpose $purpose)
    {        
        return view('user.long_run_goals.create', [
            'purpose' => $purpose,
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
        LongRunGoal::create($request->substitutable());

        return to_route('user.purposes.index')->with('status', 'success create'); 
    }

    /**
     * 編集フォーム表示
     *
     * @return \Illuminate\View\View
     */
    public function edit(LongRunGoal $longRunGoal)
    {
        return view('user.long_run_goals.edit', [
            'longRunGoal' => $longRunGoal,
        ]);
    }

    /**
     * 更新
     *
     * @param UpdateRequest $request
     * @param LongRunGoal $longRunGoal
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, LongRunGoal $longRunGoal)
    {
        $longRunGoal->fill($request->substitutable())->save();

        return back()->with('status', '更新しました');
    }

    /**
     * 削除
     *
     * @param LongRunGoal $longRunGoal
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(LongRunGoal $longRunGoal)
    {
        $longRunGoal->delete();

        return to_route('user.long_run_goals.index')->with('status', '削除しました');
    }
}