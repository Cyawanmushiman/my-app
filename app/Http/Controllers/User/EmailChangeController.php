<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\User\EmailChangeVerification;

class EmailChangeController extends Controller
{
    // ① メールアドレス変更フォーム表示
    public function showChangeForm()
    {
        return view('user.email_changes.change');
    }

    // ② 確認メール送信処理
    public function sendVerificationEmail(Request $request)
    {
        $user = \Auth::user();
        $token = \Str::random(60);

        // ユーザー情報に一時的なメールとトークンを保存
        $user->pending_email = $request->new_email;
        $user->email_verification_token = $token;
        $user->save();

        // 確認メール送信
        \Mail::to($user->pending_email)->send(new EmailChangeVerification($user));

        return back()->with('status', '確認メールを送信しました。新しいメールアドレスを確認してください。');
    }

    // ③ メールリンクの検証とメールアドレスの更新
    public function verifyNewEmail($token)
    {
        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            return redirect()->route('user.email.change.form')->withErrors(['token' => '無効な確認リンクです。']);
        }

        // メールアドレスの更新
        $user->email = $user->pending_email;
        $user->pending_email = null;
        $user->email_verification_token = null;
        $user->save();

        return redirect()->route('user.email.change.form')->with('status', 'メールアドレスが正常に変更されました。');
    }
}
