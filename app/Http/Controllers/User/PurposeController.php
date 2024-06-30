<?php

namespace App\Http\Controllers\User;

use DateTime;
use App\Models\Purpose;
use Illuminate\View\View;
use App\Models\LongRunGoal;
use Illuminate\Http\Request;
use App\Services\PurposeService;
use App\Http\Controllers\Controller;
use App\Services\LongRunGoalService;
use Illuminate\Http\RedirectResponse;
use App\Services\MiddleRunGoalService;
use App\Http\Requests\User\PurposeController\StoreRequest;
use App\Http\Requests\User\PurposeController\UpdateRequest;
use App\Util\GoalProgress;

class PurposeController extends Controller
{    
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('user.purposes.index', [
            'gpData' => GoalProgress::getGoalProgressData(auth()->user()->purpose),
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
    public function edit(Purpose $purpose): View
    {
        return view('user.purposes.edit', [
            'purpose' => $purpose,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Purpose $purpose): RedirectResponse
    {
        $purpose->update($request->substitutable());

        return to_route('user.purposes.index')->with('status', 'success update purpose');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
