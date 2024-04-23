<?php
$secret = 'Cyawanmushi0314';
$json = file_get_contents('php://input');
$data = json_decode($json);

$signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];

if ($signature) {
    $hash = 'sha1=' . hash_hmac('sha1', $json, $secret);
    if (hash_equals($hash, $signature)) {
        exec('cd /home/bitnami/laravel-project/my-app && git pull origin main');
        echo 'Success';
    } else {
        header('HTTP/1.0 403 Forbidden');
        echo 'Invalid signature';
    }
} else {
    header('HTTP/1.0 400 Bad Request');
    echo 'No signature provided';
}
