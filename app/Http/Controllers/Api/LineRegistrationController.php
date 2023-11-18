<?php

namespace App\Http\Controllers\Api;

use App\Models\LineUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LineRegistrationController extends Controller
{
    public function webhook(Request $request)
    {
        \Log::debug($request->all());
        // $lineUser = LineUser::firstOrCreate([
        //     'line_id' => $request->input('events.0.source.userId'),
        // ]);

        // $lineUser->update([
        //     'name' => $request->input('events.0.source.displayName'),
        // ]);

        return response()->json([
            'status' => 'ok',
        ]);
    }
}
