<?php

namespace App\Http\Controllers\User;

use DateTime;
use App\Models\Purpose;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\User\PurposeController\StoreRequest;
use App\Http\Requests\User\PurposeController\UpdateRequest;

class PurposeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $purpose = Purpose::with(['longRunGoal', 'longRunGoal.middleRunGoals'])->where('user_id', auth()->id())->first();
        $progressbarPer = 0;

        if ($purpose === null) {
            return view('user.purposes.index', [
                'purpose' => $purpose,
                'longRunGoal' => null,
                'progressbarPer' => $progressbarPer,
            ]);
        }

        // 未来の最終ゴールまでの進捗を計算
        if ($purpose->longRunGoal) {
            // 最終日までの日数を取得
            $totalDayCount = $purpose->longRunGoal->start_on->diff($purpose->longRunGoal->finish_on)->days;
            $todayDayCount = $purpose->longRunGoal->start_on->diff(today())->days;
            // 進捗率を計算
            $progressbarPer = $todayDayCount / $totalDayCount * 100;
        }

        // 中期目標の座標を取得
        $middleGoalMap = [];
        if ($purpose->middleRunGoals) {
            foreach ($purpose->middleRunGoals as $middleRunGoal) {
                // 最終日までの日数を取得
                $totalDayCount = $purpose->longRunGoal->start_on->diff($purpose->longRunGoal->finish_on)->days;
                $middleGoalCount = $purpose->longRunGoal->start_on->diff($middleRunGoal->finish_on)->days;
                // 進捗率を計算
                $middleProgressbarPer = $middleGoalCount / $totalDayCount * 100;

                $middleGoalMap[$middleProgressbarPer] = $middleRunGoal->finish_on->format('Y/m/d') . "　" . $middleRunGoal->title;
            }
        }

        // ランダムでgifを取得
        $gifKey = array_rand(Purpose::GIF_IMAGE_NAMES);
        // urlを取得
        $gifImageUrl = asset('images/gifs/' . Purpose::GIF_IMAGE_NAMES[$gifKey]);
        return view('user.purposes.index', [
            'purpose' => $purpose,
            'longRunGoal' => $purpose->longRunGoal,
            'progressbarPer' => $progressbarPer,
            'middleGoalMap' => $middleGoalMap,
            'gifImageUrl' => $gifImageUrl,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('user.purposes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $params = array_merge($request->substitutable(), ['user_id' => auth()->id()]);
        Purpose::create($params);

        return to_route('user.purposes.index')->with('status', 'success create purpose');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purpose $purpose): View
    {
        return view('user.purposes.edit', [
            'purpose' => $purpose,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Purpose $purpose): RedirectResponse
    {
        $purpose->update($request->substitutable());

        return to_route('user.purposes.index')->with('status', 'success update purpose');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
