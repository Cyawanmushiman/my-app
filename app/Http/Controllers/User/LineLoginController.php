<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use GuzzleHttp\Exception\RequestException;

class LineLoginController extends Controller
{
    // Lineログイン画面を表示
    public function lineLogin(): RedirectResponse
    {
        $state = Str::random(32);
        $nonce  = Str::random(32);

        $uri ="https://access.line.me/oauth2/v2.1/authorize?";
        $response_type = "response_type=code";
        $client_id = "&client_id=" . config('services.line.client_id');
        $redirect_uri ="&redirect_uri=" . config('services.line.redirect_uri');
        $state_uri = "&state=" . $state;
        $scope = "&scope=profile%20openid%20email";
        $prompt = "&prompt=consent";
        $nonce_uri = "&nonce=";
        $disable_auto_login = "&disable_auto_login=true";

        $uri = $uri . $response_type . $client_id . $redirect_uri . $state_uri . $scope . $prompt . $nonce_uri . $disable_auto_login;

        return redirect($uri);
    }
      
    // アクセストークン取得
    public function getTokens(Request $req): array
    {
        $headers = [ 'Content-Type: application/x-www-form-urlencoded' ];
        $post_data = [
            'grant_type'    => 'authorization_code',
            'code'          => $req['code'],
            'redirect_uri'  => config('services.line.redirect_uri'),
            'client_id'     =>  config('services.line.client_id'),
            'client_secret' => config('services.line.client_secret'),
        ];
        $url = 'https://api.line.me/oauth2/v2.1/token';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post_data));

        $res = curl_exec($curl);
        curl_close($curl); 
        $json = json_decode($res);
        
        $accessToken = $json->access_token;
        $refreshToken = $json->refresh_token;
        $idToken = $json->id_token;

        return [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
            'id_token' => $idToken,
        ];
    }
    
    // プロフィール取得
    public function getProfile(string $at): object
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $at]);
        curl_setopt($curl, CURLOPT_URL, 'https://api.line.me/v2/profile');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
        $res = curl_exec($curl);
        curl_close($curl);
    
        $json = json_decode($res);
    
        return $json;
    }
    
    public function getVerifyData(string $idToken): array
    {
        $client = new Client();
    
        $url = 'https://api.line.me/oauth2/v2.1/verify';
    
        try {
            $response = $client->post($url, [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                'form_params' => [
                    'id_token' => $idToken,
                    'client_id' => config('services.line.client_id')
                ]
            ]);
    
            $body = $response->getBody();
            $content = json_decode($body->getContents(), true);
    
            return $content;
    
        } catch (RequestException $e) {
            // エラーハンドリング
            if ($e->hasResponse()) {
                $errorResponse = $e->getResponse();
                return json_decode($errorResponse->getBody()->getContents(), true);
            }  
                return ['error' => 'リクエストに失敗しました。'];
            
        }
    }
    
    // ログイン後のページ表示
    public function callback(Request $request): RedirectResponse
    {
        $tokens = $this->getTokens($request);
        
        $profile = $this->getProfile($tokens['access_token']);
        
        $verifyData = $this->getVerifyData($tokens['id_token']);
        
        // ユーザー情報あるか確認
        $user = User::where('email', $verifyData['email'])->first();
        
        // すでに連携済みの場合はログイン
        if ($user && $user->line_id) {
            Auth::login($user);
            return to_route('user.home');
        }
        
        // すでに登録済みの場合は連携
        if ($user && $user->line_id === null) {
            $user->update([
                'provider' => 'line',
                'line_id' => $profile->userId,
            ]);
            
            Auth::login($user);
            
            if (url()->previous() === route('user.notification_settings.line_alignment')) {
                return to_route('user.notification_settings.line_notification_guide')->with('status', 'LINEと連携しました。通知設定を行ってください。');
            }
            
            return to_route('user.home');
        }
        
        // なければ登録してからログイン
        $user = User::create([
            'provider' => 'line',
            'line_id' => $profile->userId,
            'name' => $profile->displayName,
        ]);

        Auth::login($user);
        
        return to_route('user.home');
    }
}
