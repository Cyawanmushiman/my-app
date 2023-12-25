<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Notifications\User\EventAdded;

class WebPushController extends Controller
{
    // public function __construct() {
    //     $this->middleware('auth');  // 要ログイン
    // }
    
    public function create(): View
    {
        return view('user.web_pushes.create');
    }
    
    public function store(Request $request): JsonResponse
    {
        $this->validate($request, [
            'endpoint'    => 'required',
            'keys.auth'   => 'required',
            'keys.p256dh' => 'required'
        ]);
    
        $endpoint = $request->endpoint;
        $token = $request->keys['auth'];
        $key = $request->keys['p256dh'];
        $user = $request->user();
        $user->updatePushSubscription($endpoint, $key, $token);
    
        return response()->json([
            'success' => true
        ], 200);
    }
    
    public function send(Request $request): void
    {
        $users = User::all();
        
        \Notification::send($users, new EventAdded());
    }
}
