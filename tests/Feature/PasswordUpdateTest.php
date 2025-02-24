<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PasswordUpdateTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        // テストユーザー作成
        $this->user = User::factory()->create([
            'password' => \Hash::make('CurrentPass123!'),
        ]);
    }

    public function testパスワードを正常に更新できる(): void
    {
        $response = $this->actingAs($this->user)
            ->put(route('user.passwords.update'), [
                'current_password' => 'CurrentPass123!',
                'new_password' => 'NewPass123!',
                'new_password_confirmation' => 'NewPass123!',
            ]);

        $response->assertRedirect(route('user.passwords.edit'))
            ->assertSessionHas('status', 'パスワードが更新されました。');

        $this->assertTrue(\Hash::check('NewPass123!', $this->user->fresh()->password));
    }

    public function test現在のパスワードが間違っている場合は更新できない(): void
    {
        $response = $this->actingAs($this->user)
            ->put(route('user.passwords.update'), [
                'current_password' => 'WrongPass123!',
                'new_password' => 'NewPass123!',
                'new_password_confirmation' => 'NewPass123!',
            ]);

        $response->assertSessionHasErrors('current_password');
        $this->assertTrue(\Hash::check('CurrentPass123!', $this->user->fresh()->password));
    }

    public function test新しいパスワードと確認用パスワードが一致しない場合は更新できない(): void
    {
        $response = $this->actingAs($this->user)
            ->put(route('user.passwords.update'), [
                'current_password' => 'CurrentPass123!',
                'new_password' => 'NewPass123!',
                'new_password_confirmation' => 'MismatchPass!',
            ]);

        $response->assertSessionHasErrors('new_password');
        $this->assertTrue(\Hash::check('CurrentPass123!', $this->user->fresh()->password));
    }

    public function test新しいパスワードが現在のパスワードと同じ場合は更新できない(): void
    {
        $response = $this->actingAs($this->user)
            ->put(route('user.passwords.update'), [
                'current_password' => 'CurrentPass123!',
                'new_password' => 'CurrentPass123!',
                'new_password_confirmation' => 'CurrentPass123!',
            ]);

        $response->assertSessionHasErrors('new_password');
        $this->assertTrue(\Hash::check('CurrentPass123!', $this->user->fresh()->password));
    }

    public function testパスワードが短すぎる場合は更新できない(): void
    {
        $response = $this->actingAs($this->user)
            ->put(route('user.passwords.update'), [
                'current_password' => 'CurrentPass123!',
                'new_password' => 'short',
                'new_password_confirmation' => 'short',
            ]);

        $response->assertSessionHasErrors('new_password');
        $this->assertTrue(\Hash::check('CurrentPass123!', $this->user->fresh()->password));
    }

    public function test未認証ユーザーはパスワード更新ページにアクセスできない(): void
    {
        $response = $this->get(route('user.passwords.edit'));
        $response->assertRedirect('/user/login'); // 認証ミドルウェアのリダイレクト確認

        $response = $this->put(route('user.passwords.update'), [
            'current_password' => 'CurrentPass123!',
            'new_password' => 'NewPass123!',
            'new_password_confirmation' => 'NewPass123!',
        ]);
        $response->assertRedirect('/user/login');
    }
}
