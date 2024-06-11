<?php

namespace App\Http\Controllers\User;

use App\Models\MindMap;
use Illuminate\View\View;
use App\Models\DailyRunGoal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class SetUpController extends Controller
{
    // 最初の目標設定画面の表示
    public function createFirstGoal(): View
    {
        return view('user.set_ups.create_first_goal');
    }

    // 最初の目標設定画面の保存
    public function storeFirstGoal(Request $request): RedirectResponse
    {
        auth()->user()->update([
            'has_first_goal' => true,
        ]);

        return to_route('user.set_ups.create_mind_map', [
            'firstGoalText' => $request->first_goal_text,
        ]);
    }

    // マインドマップ作成画面の表示
    public function createMindMap(Request $request): View
    {
        return view('user.set_ups.create_mind_map', [
            'firstGoalText' => $request->firstGoalText,
        ]);
    }

    // マインドマップの保存
    public function storeMindMap(Request $request): RedirectResponse
    {
        \DB::transaction( function () use ($request) {
            if (auth()->user()->is_mind_map_create === false) {
                MindMap::create([
                    'user_id' => auth()->id(),
                    'mind_data_json' => $request->mind_data_json,
                ]);
    
                auth()->user()->update([
                    'is_mind_map_create' => true,
                ]);
            } else {
                MindMap::where('user_id', auth()->id())->first()->update([
                    'mind_data_json' => $request->mind_data_json,
                ]);
            }
        });
        
        return to_route('user.set_ups.create_daily_goal');
    }

    // 今日の目標の表示
    public function createDailyGoal(): View
    {
        return view('user.set_ups.create_daily_goal');
    }

    // 今日の目標の保存
    public function storeDailyGoal(Request $request): RedirectResponse
    {
        auth()->user()->update([
            'has_daily_goal' => true,
        ]);

        DailyRunGoal::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
        ]);

        return to_route('user.home')->with('status', 'これで初期設定は完了です。お疲れ様でした。');
    }
}
