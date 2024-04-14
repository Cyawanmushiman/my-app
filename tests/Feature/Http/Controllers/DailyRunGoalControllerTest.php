<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\DailyRunGoal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DailyRunGoalControllerTest extends TestCase
{
    public function test_未ログインの場合はログイン画面にリダイレクトされる()
    {
        $response = $this->get(route('user.daily_run_goals.index'));
        $response->assertRedirect(route('user.login'));
    }   
    
    public function test_自分の毎日の目標一覧が表示される()
    {
        $me = $this->login();
        
        DailyRunGoal::factory()->create([
            'user_id' => $me->id,
            'title' => '今日も走る',
        ]);
        
        $response = $this->get(route('user.daily_run_goals.index'));
        $response->assertOk();
        
        $response->assertSee('今日も走る');
    }
    
    public function test_自分の毎日の目標が一つもなければ、「毎日の目標が登録されていません」が表示される()
    {
        $me = $this->login();
        
        $response = $this->get(route('user.daily_run_goals.index'));
        $response->assertOk();
        
        $response->assertSee('毎日の目標が登録されていません');
    }
    
    public function test_自分の毎日の目標を登録できる()
    {
        $me = $this->login();
        
        $response = $this->post(route('user.daily_run_goals.store'), [
            'user_id' => $me->id,
            'title' => '今日も走る',
        ]);
        
        $response->assertRedirect(route('user.daily_run_goals.index'));
        
        $this->get(route('user.daily_run_goals.index'))
            ->assertOk()
            ->assertSee('作成しました');
        
        $this->assertDatabaseHas('daily_run_goals', [
            'user_id' => $me->id,
            'title' => '今日も走る',
        ]);
    }
}
