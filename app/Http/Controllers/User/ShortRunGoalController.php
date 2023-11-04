<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ShortRunGoalController\StoreRequest;
use App\Http\Requests\User\ShortRunGoalController\UpdateRequest;
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
    public function index(Request $request)
    {
        return view('user.short_run_goals.index', [
            'shortRunGoals' => ShortRunGoal::latest()->paginate(12),
        ]);
    }

    /**
     * 登録フォーム表示
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {        
        return view('user.short_run_goals.create');
    }

    /**
     * 詳細表示
     *
     * @return \Illuminate\View\View
     */
    public function show(ShortRunGoal $shortRunGoal)
    {        
        return view('user.short_run_goals.show', [
            'shortRunGoal' => $shortRunGoal,
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
        return view('user.short_run_goals.edit', [
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