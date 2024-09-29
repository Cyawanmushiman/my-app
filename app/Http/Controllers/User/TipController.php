<?php

namespace App\Http\Controllers\User;

use App\Models\Tip;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\User\TipController\UpdateRequest;

class TipController extends Controller
{
        /**
     * Show the form for editing the specified resource.
     */
    public function edit(): View
    {
        $tip = Tip::where('user_id', auth()->id())->first() ?? new Tip();
        
        return view('user.tips.edit', [
            'tip' => $tip,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request): RedirectResponse
    {
        $tip = Tip::where('user_id', auth()->id())->first() ?? new Tip();
        
        $tip->fill($request->substitutable());
        $tip->user_id = auth()->id();
        $tip->save();
        
        return back()->with('status', 'success');
    }
}
