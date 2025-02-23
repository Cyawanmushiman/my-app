<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use App\Models\User;
use App\Mail\User\EmailChangeVerification;

class EmailChangeTest extends TestCase
{
    /** @test */
    public function ユーザーは新しいメールアドレスへの確認メールを受け取る()
    {
        Mail::fake();

        // ユーザー作成 & 認証
        $user = User::factory()->create();
        $this->actingAs($user);

        // メール変更リクエスト送信
        $response = $this->post(route('user.email.change.send'), [
            'new_email' => 'newemail@example.com',
        ]);
        $response->assertSessionHas('status', '確認メールを送信しました。新しいメールアドレスを確認してください。');
        
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'pending_email' => 'newemail@example.com',
        ]);

        // メールが送信されたか確認
        Mail::assertSent(EmailChangeVerification::class, function ($mail) use ($user) {
            return $mail->user->id === $user->id && $mail->hasTo('newemail@example.com');
        });
    }

    /** @test */
    public function 確認メールのリンクをクリックするとメールアドレスが更新される()
    {
        // ユーザー作成 & トークン付与 & 認証
        $user = User::factory()->create([
            'pending_email' => 'newemail@example.com',
            'email_verification_token' => 'testtoken123',
        ]);
        $this->actingAs($user);

        // 確認リンクにアクセス
        $response = $this->get(route('user.email.change.verify', ['token' => 'testtoken123']));

        $response->assertRedirect(route('user.email.change.form'));
        $response->assertSessionHas('status', 'メールアドレスが正常に変更されました。');

        // メールアドレスが更新されたことを確認
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => 'newemail@example.com',
            'pending_email' => null,
            'email_verification_token' => null,
        ]);
    }

    /** @test */
    public function 無効なトークンではメールアドレスは変更されない()
    {
        $user = User::factory()->create([
            'pending_email' => 'newemail@example.com',
            'email_verification_token' => 'validtoken123',
        ]);
        $this->actingAs($user);

        // 無効なトークンでアクセス
        $response = $this->get(route('user.email.change.verify', ['token' => 'invalidtoken456']));

        $response->assertRedirect(route('user.email.change.form'));
        $response->assertSessionHasErrors(['token' => '無効な確認リンクです。']);

        // データベースに変更がないことを確認
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => $user->email,
            'pending_email' => 'newemail@example.com',
        ]);
    }

    /** @test */
    public function 既に使用されているメールアドレスには変更できない()
    {
        User::factory()->create([
            'email' => 'existing@example.com',
        ]);

        $user = User::factory()->create();
        $this->actingAs($user);

        // 既存のメールアドレスでリクエスト
        $response = $this->post(route('user.email.change.send'), [
            'new_email' => 'existing@example.com',
        ]);

        $response->assertSessionHasErrors(['new_email' => 'そのメールアドレスはすでに使用されています。']);
    }
}