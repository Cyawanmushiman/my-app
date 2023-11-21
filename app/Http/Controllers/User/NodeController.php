<?php

namespace App\Http\Controllers\User;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NodeController extends Controller
{
    public function index(): View
    {
        $longRunGoal = auth()->user()->longRunGoal->load('middleRunGoals.shortRunGoals');
        return view('user.nodes.index', [
            'longRunGoal' => $longRunGoal,
        ]);
    }
}
