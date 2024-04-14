<?php

namespace App\Library;

use App\Models\User;

class LineMessageApiLibrary
{
    public static function sendLineMessage(string $message, int $userId): string
    {
        $channelAccessToken = config('services.line.access_token');
        $url = 'https://api.line.me/v2/bot/message/push';
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $channelAccessToken,
            // 'X-Line-Retry-Key' => '{UUID}', // 必要に応じてUUIDを生成し使用してください
        ];
        $lineId = User::find($userId)->line_id;
        
        $body = [
            'to' => $lineId, // 実際のユーザーIDまたはグループIDに置き換えてください 
            'messages' => [
                [
                    'type' => 'text',
                    'text' => $message,
                ],
            ]
        ];

        $response = \Http::withHeaders($headers)->post($url, $body);

        // レスポンス内容を確認
        return $response->body();
    }
}