<?php

$LOG_FILE = dirname(__FILE__) . '/webhook.log';
$SECRET_KEY = 'Cyawanmushi0314';
file_put_contents( $LOG_FILE, date( "[Y-m-d H:i:s]" ) . " Start Deploy\n", FILE_APPEND | LOCK_EX );

$header = getallheaders();
$hmac = hash_hmac('sha1', $HTTP_RAW_POST_DATA, $SECRET_KEY);
if ( isset($header['X-Hub-Signature']) && $header['X-Hub-Signature'] === 'sha1='.$hmac ) {
    $payload = json_decode($HTTP_RAW_POST_DATA, true);  // 受け取ったJSONデータ
    // ここに実行したいコードを書く
    // exec('git pull origin main 2>&1');
    exec('cd /home/bitnami/laravel-project/my-app && git pull origin main');
    
    // ログを残す
    file_put_contents($LOG_FILE, date("[Y-m-d H:i:s]")." git pull\n", FILE_APPEND|LOCK_EX);
    
} else {
    // 認証失敗
    file_put_contents($LOG_FILE, date("[Y-m-d H:i:s]")." invalid access: ".$_SERVER['REMOTE_ADDR']."\n", FILE_APPEND|LOCK_EX);
}
