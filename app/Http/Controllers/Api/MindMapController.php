<?php

namespace App\Http\Controllers\Api;

use App\Models\MindMap;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MindMapController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $mindDataJson = $request['params']['mind_data_json'];
        $userId = $request['params']['user_id'];

        MindMap::find($userId)->update([
            'mind_data_json' => $mindDataJson,
        ]);

        return response()->json([
            'status' => 'success',
            'mindDataJson' => $mindDataJson,
            'userId' => $userId,
            'message' => '保存しました',
        ]);
    }
}
