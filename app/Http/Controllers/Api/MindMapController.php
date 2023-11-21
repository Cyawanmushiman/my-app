<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MindMapController extends Controller
{
    public function store(Request $request)
    {
        $mindDataJson = $request->input('mind_data_json');
        $userId = $request->input('user_id');

        return response()->json([
            'mindDataJson' => $mindDataJson,
            'userId' => $userId,
        ]);
    }
}
