<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    /**
     * ホーム画面
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        return view('user.home');
    }

    public function store(Request $request): RedirectResponse
    {
        return redirect()->route('home');
    }
}