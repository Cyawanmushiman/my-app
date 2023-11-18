<?php

namespace App\Http\Controllers\Api;

use App\Models\LineUser;
use Illuminate\Http\Request;
use LINE\LINEBot;
use LINE\LINEBot\Event\FollowEvent;
use LINE\LINEBot\Event\UnfollowEvent;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class LineRegistrationController extends Controller
{
    // webhookメソッド
    public function webhook(Request $request)
    {
        $channel_secret = env('LINE_MESSENGER_SECRET');
        $access_token = env('LINE_CHANNEL_TOKEN');

        $signature = null;
        $request_body = $request->getContent();
        $client = new CurlHTTPClient($access_token);
        $bot = new LINEBot($client, ['channelSecret' => $channel_secret]);

        $events = $bot->parseEventRequest($request_body, $signature);
        foreach ($events as $event) {
            $line_id = $event->getEventSourceId();
            $reply_token = $event->getReplyToken();
            // フォローイベントの場合
            if ($event instanceof FollowEvent) {
                // line_usersテーブルへ登録する
                $mode = $event->getMode();
                $profile = $bot->getProfile($line_id)->getJSONDecodedBody();
                $display_name = $profile['displayName'];
                $line_user = LineUser::firstOrNew(['line_id' => $line_id]);
                $line_user->mode = $mode;
                $line_user->name = $display_name;
                $line_user->save();

                // リプライテキストを設定し、フォローしてくれたユーザーに返信する
                $text_message = new TextMessageBuilder('フォローありがとうございます。');
                $bot->replyMessage($reply_token, $text_message);
            // フォロー解除イベントの場合
            } else if ($event instanceof UnfollowEvent) {
                // line_usersテーブルからデータを削除する
                $line_user = LineUser::findByLineId($line_id);
                if (!empty($line_user) && $line_user instanceof LineUser) {
                    $line_user->delete();
                }
            }
        }
    }
}
