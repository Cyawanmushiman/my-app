<?php

namespace App\Http\Controllers\User;

use Illuminate\View\View;
use App\Models\Challenging;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\User\ChallengingController\StoreRequest;
use App\Models\ChallengingOpponentInfo;
use App\Models\UserChallengeAbility;

class ChallengingController extends Controller
{
    /**
     * Show the form for creating the specified resource.
     */
    public function create(): View
    {
        return view('user.challengings.create');
    }

    /**
     * store the specified resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        // challengingテーブルにを作成
        $challenging = Challenging::create([
            'user_id' => auth()->id(),
            'reward' => $request->ForChallenging()['reward'],
            'reward_link' => $request->ForChallenging()['reward_link'],
        ]);

        // challenging_opponent_infoテーブルにを作成
        ChallengingOpponentInfo::create([
            'challenging_id' => $challenging->id,
            'name' => $request->ForChallengingOpponentInfo()['opponent_name'],
            'max_hit_point' => $request->ForChallengingOpponentInfo()['opponent_max_hit_point'],
        ]);

        // user_challenge_abilityテーブルを作成
        UserChallengeAbility::create([
            'user_id' => auth()->id(),
            'challenging_id' => $challenging->id,
            'hit_point' => $request->ForUserChallengeAbility()['user_max_hit_point'],
        ]);

        return to_route('user.home')->with('status', 'success');
    }
    
    // 勝利画面の表示
    public function displayWin(Challenging $challenging): View
    {
        return view('user.challengings.display_win', [
            'challenging' => $challenging,
        ]);
    }
}
