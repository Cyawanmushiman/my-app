<?php

namespace App\Http\Controllers\User;

use Storage;
use App\Models\MindMap;
use Illuminate\View\View;
use App\Library\FileLibrary;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class MindMapController extends Controller
{
    public function index(): View
    {
        return view('user.mindMaps.index', [
            'mindMaps' => MindMap::where('user_id', auth()->id())->orderBy('sort_number')->get(),
        ]);
    }
    
    public function create(): View
    {
        return view('user.mindMaps.create');
    }
    
    // マインドマップの保存
    public function store(Request $request): RedirectResponse
    {
        $arrayData = json_decode($request->mind_data_json, true);
        $title = $arrayData['data']['topic'];  
        
        MindMap::create([
            'user_id' => auth()->id(),
            'title' => $title,
            'mind_data_json' => $request->mind_data_json,
        ]);

        return to_route('user.mind_maps.index');
    }
    
    public function edit(MindMap $mindMap): View
    {
        // /storage/images/tempMindMaps/ディレクトリ内のファイルを削除
        \Storage::deleteDirectory('public/images/tempMindMaps');
        return view('user.mindMaps.edit', [
            'mindMap' => $mindMap,
        ]);
    }
    
    public function destroy(MindMap $mindMap): RedirectResponse
    {
        \DB::transaction(function () use ($mindMap) {
            $mindData = json_decode($mindMap->mind_data_json, true);
            $deleteImageNames = self::findImageIds($mindData);
            if ( ! empty($deleteImageNames)) {
                // 画像ファイルを削除
                foreach ($deleteImageNames as $deleteImageName) {
                    $imageUrl = '/storage/images/mindMaps/' . $deleteImageName;
                    FileLibrary::deleteFile($imageUrl);
                }
            }
            
            $mindMap->delete();
        });
        
        return to_route('user.mind_maps.index');
    }
    
    // 再起的に画像名を取得する
    private function findImageIds($array, &$results = []) {
        foreach ($array as $key => $value) {
            if (\is_array($value)) {
                // 配列の場合は再帰的に探索
                self::findImageIds($value, $results);
            } else {
                // キーが'id'かつ値が'img-'で始まる場合は結果に追加
                if ($key === 'id' && strpos($value, 'img-') === 0) {
                    $nonImgValue = str_replace('img-', '', $value);
                    $results[] = explode('-', $nonImgValue)[0];
                }
            }
        }
        return $results;
    }
    
    public function editSort(): View
    {
        return view('user.mindMaps.edit_sort', [
            'mindMaps' => MindMap::where('user_id', auth()->id())->orderBy('sort_number')->get(),
        ]);
    }
    
    public function updateSort(Request $request): Response
    {
        \DB::transaction(function () use ($request) {
            foreach ($request->mindMaps as $index => $mindMap) {
                $sortNumber = $index + 1;
                MindMap::where('id', $mindMap['id'])->update(['sort_number' => $sortNumber]);
            }
        });
        
        return response('success', 200);
    }
}
