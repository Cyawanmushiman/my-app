<?php

namespace App\Services;

use App\Models\ChallengingLog;

class ChallengingLogService
{
    public function store(array $dailyRunGoalIds): ChallengingLog
    {
        // 達成できた目標の数
        $archivedCount= count($dailyRunGoalIds);
        // 達成できなかった目標の数
        $unArchivedCount = auth()->user()->dailyRunGoals()->count() - $archivedCount;
        
        // challengingLogsテーブルにを作成
        $challengingLog = ChallengingLog::create([
            'challenging_id' => auth()->user()->challenging->id,
            'archive_count' => $archivedCount,
            'un_archive_count' => $unArchivedCount,
        ]);
        
        return $challengingLog;
    }
}