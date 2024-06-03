<?php

namespace App\Http\Controllers\Api;

use App\Models\MindMap;
use App\Library\FileLibrary;
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
    
    public function uploadImage(Request $request): \Illuminate\Http\JsonResponse
    {
        if ($request->hasFile('image_file')) {
            $imageFolderPath = 'public/images/mindMaps';
            $inspireImageUrl = FileLibrary::uploadFile($request->file('image_file'), $imageFolderPath);
            $uniqueFileName = explode('/', $inspireImageUrl['url'])[4];
            
            return response()->json([
                'status' => 'success',
                'message' => '画像をアップロードしました',
                'uniqueFileName' => $uniqueFileName,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => '画像をアップロードできませんでした',
            ]);
        }
    }
    
    public function deleteImages(Request $request): \Illuminate\Http\JsonResponse
    {
        $deleteImageNames = $request['params']['delete_image_names'];
        foreach ($deleteImageNames as $deleteImageName) {
            $imageUrl = '/storage/images/mindMaps/' . $deleteImageName;
            FileLibrary::deleteFile($imageUrl);
        }
        
        return response()->json([
            'status' => 'success',
            'message' => '画像を削除しました',
        ]);
    }
}
