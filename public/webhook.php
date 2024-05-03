<?php
// エラーログの有効化
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);

// POSTデータの取得
$postData = file_get_contents('php://input');

// データのロギング（デバッグ用）
file_put_contents('webhook.log', $postData . "\n", FILE_APPEND);

// 何かしらのレスポンスを返す
http_response_code(200);

exec('cd /home/bitnami/laravel-project/my-app && git pull origin main');
// $LOG_FILE = dirname(__FILE__) . '/webhook.log';

// $SECRET_KEY = 'Cyawanmushi0314';  // GitHubのWebhookで設定したSecretと同じ値
// $header = getallheaders();
// $hmac = hash_hmac('sha1', $HTTP_RAW_POST_DATA, $SECRET_KEY);
// if ( isset($header['X-Hub-Signature']) && $header['X-Hub-Signature'] === 'sha1='.$hmac ) {
//     $payload = json_decode($HTTP_RAW_POST_DATA, true);  // 受け取ったJSONデータ
//     // ここに実行したいコードを書く
//     exec('cd /home/bitnami/laravel-project/my-app && git pull origin main');
    
//     // ログを残す
//     file_put_contents('webhook.log', date("[Y-m-d H:i:s]")." git pull\n", FILE_APPEND|LOCK_EX);
    
// } else {
//     // 認証失敗
//     file_put_contents('webhook.log', date("[Y-m-d H:i:s]")." invalid access: ".$_SERVER['REMOTE_ADDR']."\n", FILE_APPEND|LOCK_EX);
// }
