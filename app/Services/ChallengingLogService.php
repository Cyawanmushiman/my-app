<?php

namespace App\Services;

use App\Models\Challenging;
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
            'challenging_id' => auth()->user()->challengings->where('result_status', Challenging::FIGHTING)->first()->id,
            'archive_count' => $archivedCount,
            'un_archive_count' => $unArchivedCount,
        ]);
        
        return $challengingLog;
    }
    
    // 敵の情報を取得
    public function getOpponentInfo(int $challengingLogId): array
    {
        $challengingLog = ChallengingLog::findOrFail($challengingLogId);
        $challenging = $challengingLog->challenging->load(['challengingOpponentInfo', 'challengingLogs', 'user', 'userChallengeAbility']);

        $maxOpHitPoint = $challenging->challengingOpponentInfo->max_hit_point; // 敵の最大HP
        $totalOpDamage = $challenging->challengingLogs->where('id', '!=', $challengingLogId)->sum('archive_count'); // これまでのダメージをサマリー
        $currentOpHitPoint = $maxOpHitPoint - $totalOpDamage; // 現在のHP
        $currentOpHitPointPercentage = $currentOpHitPoint === 0 ? 0 : round($currentOpHitPoint / $maxOpHitPoint * 100); // 現在のHPの%
        $thisDamageToOp = $challengingLog->archive_count; // このターンで与えたダメージ
        $resultOpHitPoint = $currentOpHitPoint - $thisDamageToOp; // このターン後のHP
        
        return [
            'maxOpHitPoint' => $maxOpHitPoint,
            'totalOpDamage' => $totalOpDamage,
            'currentOpHitPoint' => $currentOpHitPoint,
            'currentOpHitPointPercentage' => $currentOpHitPointPercentage,
            'thisDamageToOp' => $thisDamageToOp,
            'resultOpHitPoint' => $resultOpHitPoint,
        ];
    }
    
    // ユーザーの情報を取得
    public function getUserInfo(int $challengingLogId): array
    {
        $challengingLog = ChallengingLog::findOrFail($challengingLogId);
        $challenging = $challengingLog->challenging->load(['challengingOpponentInfo', 'challengingLogs', 'user', 'userChallengeAbility']);
        
        $maxUserHitPoint = $challenging->userChallengeAbility->hit_point; // 勇者の最大HP
        $totalUserDamage = $challenging->challengingLogs->where('id', '!=', $challengingLogId)->sum('un_archive_count'); // これまでのダメージをサマリー
        $currentUserHitPoint = $maxUserHitPoint - $totalUserDamage; // 現在のHP
        $currentUserHitPointPercentage = $currentUserHitPoint === 0 ? 0 : round($currentUserHitPoint / $maxUserHitPoint * 100); // 現在のHPの%
        $thisDamageToUser = $challengingLog->un_archive_count; // このターンで受けたダメージ
        $resultUserHitPoint = $currentUserHitPoint - $thisDamageToUser; // このターン後のHP
        
        return [
            'maxUserHitPoint' => $maxUserHitPoint,
            'totalUserDamage' => $totalUserDamage,
            'currentUserHitPoint' => $currentUserHitPoint,
            'currentUserHitPointPercentage' => $currentUserHitPointPercentage,
            'thisDamageToUser' => $thisDamageToUser,
            'resultUserHitPoint' => $resultUserHitPoint,
        ];
    }
}