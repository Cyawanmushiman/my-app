<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\User\NotificationMail;
use App\Models\NotificationSetting;
use App\Library\LineMessageApiLibrary;

class SendMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SendMessage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notification Settingで設定した時間にメッセージを送信する';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('SendMessageコマンドが実行されました');
        $notificationSettings = NotificationSetting::where('day_of_week', date('l'))
            ->where('action_time', date('H:i'))
            ->where('is_enable', true)
            ->get();
            
        foreach ($notificationSettings as $notificationSetting) {
            $this->info($notificationSetting->user->name . 'さんにメッセージを送信します');
            if ($notificationSetting->isSendEmail()) {
                $this->info('メールを送信します');
                
                // メール送信処理
                \Mail::to($notificationSetting->user->email)->send(new NotificationMail($notificationSetting->content));
            }
            if ($notificationSetting->isSendLine()) {
                $this->info('LINEを送信します');
                
                // LINE送信処理
                LineMessageApiLibrary::sendLineMessage($notificationSetting->content, $notificationSetting->user_id);
            }
        }
        
        $this->info('SendMessageコマンドが正常に終了しました');
    }
}
