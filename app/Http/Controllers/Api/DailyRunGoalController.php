<?php

namespace App\Http\Controllers\Api;

use App\Models\DailyRunGoal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DailyRunGoalController extends Controller
{
    public function update(Request $request)
    {
        $dailyRunGoal = DailyRunGoal::find($request->id);
        $dailyRunGoal->is_finished = $request->is_finished;
        $dailyRunGoal->save();
        
        return response()->json([
            'message' => 'success',
        ]);
    }
}
