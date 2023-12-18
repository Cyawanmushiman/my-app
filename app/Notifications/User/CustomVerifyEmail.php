<?php

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Notifications\VerifyEmail;
use App\Mail\User\CustomVerifyEmail as UserCustomVerifyEmail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends VerifyEmail implements ShouldQueue
{
    use Queueable;

    // private Template $template;

    // private array $data;

    // /**
    //  * Create a new message instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->template = Template::where('class_name', class_basename($this))->first();
    // }

    /**
     * メール内容のURL変更するためオーバーライド
     */
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'user.verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 999999999)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return UserCustomVerifyEmail|\Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        if (static::$toMailCallback) {
            return \call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
        }
        // テキストメールで送信するためmailableから送信
        return (new UserCustomVerifyEmail($verificationUrl))
            ->to($notifiable->email);
    }
}