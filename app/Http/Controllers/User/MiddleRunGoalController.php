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
    public function index()
    {
        // 親テーブルでグループ化
        $middleRunGoals = MiddleRunGoal::with('longRunGoal')
            ->whereHas('longRunGoal', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->get();

        return view('user.middle_run_goals.index', [
            'longRunGoal' => auth()->user()->longRunGoal,
            'middleRunGoals' => $middleRunGoals,
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
        $bulkInsert = [];
        $params = $request->substitutable();
        foreach ($params['titles'] as $index => $title) {
            $bulkInsert[] = [
                'long_run_goal_id' => $params['long_run_goal_id'],
                'title' => $title,
                'finish_on' => $params['finish_ons'][$index],
            ];
        }
        \DB::table('middle_run_goals')->insert($bulkInsert);

        return to_route('user.purposes.index')->with('status', 'success create middle run goal');
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
