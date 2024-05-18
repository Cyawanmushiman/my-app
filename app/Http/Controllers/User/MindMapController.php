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
        return view('user.mindMaps.index', [
            'mindMaps' => auth()->user()->mindMaps,
        ]);
    }
    
    public function create(): View
    {
        return view('user.mindMaps.create');
    }
    
    // マインドマップの保存
    public function store(Request $request)
    {
        $arrayData = json_decode($request->mind_data_json, true);
        // "topic"フィールドの値を取得
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
        return view('user.mindMaps.edit', [
            'mindMap' => $mindMap,
        ]);
    }
    
    public function destroy(MindMap $mindMap)
    {
        $mindMap->delete();
        
        return to_route('user.mind_maps.index');
    }
}
