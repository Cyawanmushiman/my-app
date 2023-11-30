<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class SampleController extends Controller
{
    private $car;

    public function __construct(Car $car)
    {
        $this->car = $car;
    }

    public function sample1()
    {
        User::where('age', 24)->get()->map(function ($item, $key) {
            // 以下省略
        });

        return view('samples.sample1');
    }
}
