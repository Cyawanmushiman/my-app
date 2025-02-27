<?php

namespace App\Http\Controllers\User;

use Illuminate\View\View;
use App\Models\DailyScore;
use App\Models\Challenging;
use Illuminate\Http\Request;
use App\Services\DailyScoreService;
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
            'challengings' => auth()->user()->challengings,
        ]);
    }
    
    // ユーザーの過去のスコアを表示する
    public function pastScores(Request $request): View
    {
        $dailyScores = DailyScoreService::search($request->all())
            ->paginate(12)->appends($request->query());
            
        return view('user.histories.past_scores', [
            'dailyScores' => $dailyScores,
        ]);
    }
    
    // ユーザーの過去のチャレンジを表示する
    public function pastChallengings(Request $request): View
    {
        $challengings = Challenging::where('user_id', auth()->id())
            ->latest()
            ->paginate(12);
            
        return view('user.histories.past_challengings', [
            'challengings' => $challengings,
        ]);
    }
}
