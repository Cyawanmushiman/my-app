<?php

namespace App\Http\Controllers\User;

use Illuminate\View\View;
use App\Models\DailyScore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    // ユーザーの過去のスコアを表示する
    public function index(): View
    {
        $dailyScores = DailyScore::with(['dailyRunGoals'])
            ->where('user_id', auth()->id())
            ->limit(7)
            ->get();
        return view('user.histories.index', [
            'dailyScores' => $dailyScores,
        ]);
    }
    
    // ユーザーの過去のスコアを表示する
    public function pastScores(): View
    {
        $dailyScores = DailyScore::with(['dailyRunGoals'])
            ->where('user_id', auth()->id())
            ->paginate(12);
        return view('user.histories.past_scores', [
            'dailyScores' => $dailyScores,
        ]);
    }
}
