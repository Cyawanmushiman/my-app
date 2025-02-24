<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Mail\User\EmailChangeVerification;
use App\Http\Requests\User\EmailChangeController\SendVerificationEmailRequest;

class EmailChangeController extends Controller
{
    // ① メールアドレス変更フォーム表示
    public function showChangeForm(): View
    {
        return view('user.email_changes.change');
    }

    // ② 確認メール送信処理
    public function sendVerificationEmail(SendVerificationEmailRequest $request): RedirectResponse
    {
        /** @var \App\Models\User|null $user */
        $user = \Auth::user();
        $token = \Str::random(60);

        // ユーザー情報に一時的なメールとトークンを保存
        $user->update([
            'pending_email' => $request->new_email,
            'email_verification_token' => $token,
        ]);

        // 確認メール送信
        \Mail::to($user->pending_email)->send(new EmailChangeVerification($user));

        return back()->with('status', '確認メールを送信しました。新しいメールアドレスを確認してください。');
    }

    // ③ メールリンクの検証とメールアドレスの更新
    public function verifyNewEmail(string $token): RedirectResponse
    {
        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            return redirect()->route('user.email.change.form')->withErrors(['token' => '無効な確認リンクです。']);
        }

        // メールアドレスの更新
        $user->update([
            'email' => $user->pending_email,
            'pending_email' => null,
            'email_verification_token' => null,
        ]);

        return redirect()->route('user.email.change.form')->with('status', 'メールアドレスが正常に変更されました。');
    }
}
