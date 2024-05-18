<?php

namespace App\Http\Controllers\Api;

use App\Models\MindMap;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MindMapController extends Controller
{
    public function update(Request $request): \Illuminate\Http\JsonResponse
    {
        $mindDataJson = $request['params']['mind_data_json'];
        $userId = $request['params']['user_id'];
        
        $arrayData = json_decode($mindDataJson, true);
        // "topic"フィールドの値を取得
        $title = $arrayData['data']['topic'];  

        MindMap::find($request['params']['mind_map_id'])->update([
            'title' => $title,
            'mind_data_json' => $mindDataJson,
        ]);

        return response()->json([
            'status' => 'success',
            'mindDataJson' => $mindDataJson,
            'userId' => $userId,
            'message' => '更新しました',
        ]);
    }
}
