<?php

namespace App\Http\Controllers\User;

use App\Models\Inspire;
use App\Library\FileLibrary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
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
            'user_id' => auth()->id(),
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

    // デフォルトのインスパイアを設定する
    public function setDefault(): RedirectResponse
    {
        $userId = auth()->id();
        $bulkInsertData = [
            [
                'user_id' => $userId,
                'image_url' => '/images/inspires/cup.svg',
                'comment' => 'コーヒーが冷めないうちに飲むのが一番だね。今のチャンスも同じ。今、君が頑張っていることは、きっと最高のタイミングなんだ。',
            ],
            [
                'user_id' => $userId,
                'image_url' => '/images/inspires/baseball.svg',
                'comment' => 'お前が落ち込むなんて、許せない。失敗したって、それがお前の経験になるんだ。お前はこれからもっとすごいことをやってみせる。俺はお前のことを誇りに思っている。',
            ],
            [
                'user_id' => $userId,
                'image_url' => '/images/inspires/business.svg',
                'comment' => '成功への道は、自信を持って大胆に歩むことから始まるんだ。君もその一歩を踏み出せば、きっと大きな成果が待っている。恐れずに進もう！',
            ],
            [
                'user_id' => $userId,
                'image_url' => '/images/inspires/hat.svg',
                'comment' => '困難に立ち向かうのは勇気がいることです。あなたはその勇気を持っています。だから、諦めないでください。あなたならできます。',
            ],
            [
                'user_id' => $userId,
                'image_url' => '/images/inspires/dance.svg',
                'comment' => 'ダンスは止まらない。常に新しいことに挑戦する。',
            ],
            [
                'user_id' => $userId,
                'image_url' => '/images/inspires/running.svg',
                'comment' => '最後まで諦めない。走り切るのは自分のためだ。',
            ],
            [
                'user_id' => $userId,
                'image_url' => '/images/inspires/soccer.svg',
                'comment' => 'お前たちには止められない！俺のドリブルは最強だ！さあ、シュートだ！ゴールは俺のものだ！',
            ],
        ];

        Inspire::insert($bulkInsertData);

        return back()->with('status', 'デフォルトのインスパイアを設定しました');
    }
}