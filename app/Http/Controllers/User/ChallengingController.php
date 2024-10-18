<?php

namespace App\Http\Controllers\User;

use Illuminate\View\View;
use App\Models\Challenging;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\User\ChallengingController\StoreRequest;
use App\Models\ChallengingOpponentInfo;
use App\Models\UserAbility;

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
        ]);
        
        // challenging_opponent_infoテーブルにを作成
        ChallengingOpponentInfo::create([
            'challenging_id' => $challenging->id,
            'name' => $request->ForChallengingOpponentInfo()['opponent_name'],
            'max_hit_point' => $request->ForChallengingOpponentInfo()['opponent_max_hit_point'],
        ]);
        
        // user_abilityテーブルにを作成
        UserAbility::create([
            'user_id' => auth()->id(),
            'hit_point' => $request->ForUserAbility()['user_max_hit_point'],
        ]);
        
        return to_route('user.home')->with('status', 'success');
    }

}
