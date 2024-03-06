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
            ->latest()
            ->limit(7)
            ->get();
        
        $sortDailyScores = $dailyScores->sortBy(['created_at', 'asc'])->values();
        
        return view('user.histories.index', [
            'dailyScores' => $sortDailyScores,
        ]);
    }
    
    // ユーザーの過去のスコアを表示する
    public function pastScores(): View
    {
        $dailyScores = DailyScore::with(['dailyRunGoals'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(12);
        return view('user.histories.past_scores', [
            'dailyScores' => $dailyScores,
        ]);
    }
}
