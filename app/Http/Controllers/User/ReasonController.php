<?php

namespace App\Http\Controllers\User;

use App\Models\Reason;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ReasonController\UpdateRequest;

class ReasonController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $reason = Reason::where('user_id', auth()->id())->first() ?? new Reason();
        
        return view('user.reasons.edit', [
            'reason' => $reason,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request)
    {
        $reason = Reason::where('user_id', auth()->id())->first() ?? new Reason();
        
        $reason->fill($request->substitutable());
        $reason->user_id = auth()->id();
        $reason->save();
        
        return back()->with('status', 'success');
    }
}
