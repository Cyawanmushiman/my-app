<?php

namespace App\Http\Controllers\User;

use App\Models\Purpose;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\User\PurposeController\StoreRequest;

class PurposeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $purpose = Purpose::with(['longRunGoal', 'longRunGoal.middleRunGoals'])->where('user_id', auth()->id())->first();
        $progressbarPer = 0;
        return view('user.purposes.index', [
            'purpose' => $purpose,
            'progressbarPer' => $progressbarPer,
        ]);
    }
    
    
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('user.purposes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $params = array_merge($request->substitutable(), ['user_id' => auth()->id()]);
        Purpose::create($params);
        
        return to_route('user.purposes.index')->with('status', 'success create purpose');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
