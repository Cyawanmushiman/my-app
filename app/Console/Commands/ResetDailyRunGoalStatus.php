<?php

namespace App\Console\Commands;

use App\Models\DailyRunGoal;
use Illuminate\Console\Command;

class ResetDailyRunGoalStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-daily-run-goal-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset daily run goal status';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        \Log::info('Reset daily run goal status');
        $dailyRunGoals = DailyRunGoal::where('is_finished', true)->get();
        
        foreach ($dailyRunGoals as $dailyRunGoal) {
            $dailyRunGoal->is_finished = false;
            $dailyRunGoal->save();
        }
    }
}
