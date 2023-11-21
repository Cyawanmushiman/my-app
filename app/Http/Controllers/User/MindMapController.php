<?php

namespace App\Http\Controllers\User;

use App\Models\MindMap;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MindMapController extends Controller
{
    public function index(): View
    {
        // $longRunGoal = auth()->user()->longRunGoal->load('middleRunGoals.shortRunGoals');

        return view('user.mindMaps.index', [
            'mindMap' => MindMap::find(auth()->user()->id),
        ]);
    }
}
