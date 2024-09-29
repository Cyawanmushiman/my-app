<?php

namespace App\Http\Controllers\User;

use App\Models\Reason;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\User\ReasonController\UpdateRequest;

class ReasonController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(): View
    {
        $reason = Reason::where('user_id', auth()->id())->first() ?? new Reason();
        
        return view('user.reasons.edit', [
            'reason' => $reason,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request): RedirectResponse
    {
        $reason = Reason::where('user_id', auth()->id())->first() ?? new Reason();
        
        $reason->fill($request->substitutable());
        $reason->user_id = auth()->id();
        $reason->save();
        
        return back()->with('status', 'success');
    }
}
