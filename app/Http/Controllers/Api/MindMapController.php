<?php

namespace App\Http\Controllers\Api;

use App\Models\MindMap;
use App\Library\FileLibrary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

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
    
    // 一時フォルダに画像をアップロードする
    public function tempUploadImage(Request $request): \Illuminate\Http\JsonResponse
    {
        if ($request->hasFile('image_file')) {
            $imageFolderPath = 'public/images/tempMindMaps';
            $tempImageUrl = FileLibrary::uploadFile($request->file('image_file'), $imageFolderPath);
            $uniqueFileName = explode('/', $tempImageUrl['url'])[4];
            
            return response()->json([
                'status' => 'success',
                'message' => '一時フォルダに画像をアップロードしました',
                'uniqueFileName' => $uniqueFileName,
            ]);
        }  
            return response()->json([
                'status' => 'error',
                'message' => '一時フォルダに画像をアップロードできませんでした',
            ]);
        
    }
    
    public function uploadImages(Request $request): \Illuminate\Http\JsonResponse
    {
        if ($request['params']['temp_image_names'] !== []) {
            // 画像を一時フォルダから本フォルダへ移動
            $tempImageNames = $request['params']['temp_image_names'];
            foreach ($tempImageNames as $tempImageName) {
                $tempImageUrl = '/storage/images/tempMindMaps/' . $tempImageName;
                $uniqueFileName = explode('/', $tempImageUrl)[4];
                Storage::move('public/images/tempMindMaps/' . $uniqueFileName, 'public/images/mindMaps/' . $uniqueFileName);
            }
            
            return response()->json([
                'status' => 'success',
                'message' => '画像をアップロードしました',
            ]);
        }
        
        return response()->json([
            'status' => 'error',
            'message' => '画像をアップロードできませんでした',
        ]);
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
