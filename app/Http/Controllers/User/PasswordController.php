<?php

namespace App\Http\Controllers\User;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\User\PasswordController\UpdateRequest;

class PasswordController extends Controller
{
    // パスワード編集画面の表示
    public function edit(): View
    {
        return view('user.passwords.edit');
    }

    // パスワードの更新処理
    public function update(UpdateRequest $request): RedirectResponse
    {
        $user = \Auth::user();
        $user->update([
            'password' => \Hash::make($request->new_password),
        ]);

        return redirect()->route('user.passwords.edit')->with('status', 'パスワードが更新されました。');
    }
}
