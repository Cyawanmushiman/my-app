<?php

namespace App\Http\Controllers\User;

use App\Models\Reward;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\RewardController\UpdateRequest;

class RewardController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $reward = Reward::where('user_id', auth()->id())->first() ?? new Reward();
        
        return view('user.rewards.edit', [
            'reward' => $reward,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request)
    {
        $reward = Reward::where('user_id', auth()->id())->first() ?? new Reward();
        
        $reward->fill($request->substitutable());
        $reward->user_id = auth()->id();
        $reward->save();
        
        return back()->with('status', 'success');
    }

}
