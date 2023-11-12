<?php

namespace App\Http\Controllers\User;

use App\Models\Inspire;
use App\Library\FileLibrary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\InspireController\StoreRequest;
use App\Http\Requests\User\InspireController\UpdateRequest;

class InspireController extends Controller
{
    /**
     * 一覧
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('user.inspires.index', [
            'inspires' => Inspire::latest()->get(),
        ]);
    }

    /**
     * 登録フォーム表示
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {        
        return view('user.inspires.create');
    }

    /**
     * 登録
     *
     * @param StoreRequest $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $imageFolderPath = 'public/images/inspires';
        $inspireImageUrl = FileLibrary::uploadFile($request->file('image_file'), $imageFolderPath);

        $params = array_merge($request->substitutable(), [
            'image_url' => $inspireImageUrl['url'],
        ]);
        Inspire::create($params);

        return to_route('user.inspires.index')->with('status', '作成しました');
    }

    /**
     * 編集フォーム表示
     *
     * @return \Illuminate\View\View
     */
    public function edit(Inspire $inspire)
    {
        return view('user.inspires.edit', [
            'inspire' => $inspire,
        ]);
    }

    /**
     * 更新
     *
     * @param UpdateRequest $request
     * @param Inspire $inspire
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Inspire $inspire)
    {
        $inspire->update($request->substitutable());
        
        if ($request->hasFile('image_file')) {
            FileLibrary::deleteFile($inspire->image_url);
    
            $imageFolderPath = 'public/images/inspires';
            $inspireImageUrl = FileLibrary::uploadFile($request->file('image_file'), $imageFolderPath);
            
            $inspire->update([
                'image_url' => $inspireImageUrl['url'],
            ]);
        }

        return back()->with('status', '更新しました');
    }

    /**
     * 削除
     *
     * @param Inspire $inspire
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Inspire $inspire)
    {
        FileLibrary::deleteFile($inspire->image_url);
        $inspire->delete();

        return to_route('user.inspires.index')->with('status', '削除しました');
    }
}