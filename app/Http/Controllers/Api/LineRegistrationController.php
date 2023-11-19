<?php

namespace App\Http\Controllers\Api;

use App\Models\LineUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LineRegistrationController extends Controller
{
    public function webhook(Request $request): \Illuminate\Http\JsonResponse
    {
        // 友達追加時にユーザーを登録
        if ($request->input('events.0.type') === 'follow') {
            LineUser::firstOrCreate([
                'line_id' => $request->input('events.0.source.userId'),
            ]);
        }

        return response()->json([
            'status' => 'ok',
        ]);
    }
}
