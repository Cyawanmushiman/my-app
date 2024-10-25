@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <div class="d-flex justify-content-center align-items-center">
            <div class="col-6">
                <p class="text-end">
                    <i class="fas fa-history me-2"></i><a href="{{ route('user.histories.past_scores') }}">past scores</a>
                </p>
                @if ($dailyScores)
                    <canvas id="lineChart"></canvas>
                @else
                    <p>No learning records yet.</p>
                @endif
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-center">
                    @if ($challengings)
                        <img src="{{ asset('images/challengings/fighting.svg') }}" alt="fighting" class="img-fluid" style="max-width: 100px;">
                        <p>
                            <i class="fas fa-history me-2"></i><a href="{{ route('user.histories.past_challengings') }}">past challenge</a>
                        </p>
                    @else
                        <p>No challenge records yet.</p>
                    @endif
                </div>                
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
    let lineCtx = document.getElementById("lineChart");

    const dailyScores = @json($dailyScores);
    
    // m月d日の形式に変換
    let createdAtLabels = dailyScores.map(dailyScore => {
        const createdAt = new Date(dailyScore.created_at);
        return `${createdAt.getMonth() + 1}月${createdAt.getDate()}日`;
    });

    // データの設定
    let data = dailyScores.map(dailyScore => dailyScore.score);

    // 線グラフの設定
    let lineConfig = {
        type: 'line',
        data: {
            labels: createdAtLabels,
            datasets: [{
                label: 'Daily Score',
                data: data,
                borderColor: '#f88',
            }],
        },
        options: {
            scales: {
                // Y軸の最大値・最小値、目盛りの範囲などを設定する
                y: {
                    suggestedMin: 0,
                    ticks: {
                        stepSize: 20,
                    }
                }
            },
            // ツールチップの設定
            plugins: {
                tooltip: {
                    callbacks: {
                        // ツールチップに表示するラベルを設定する
                        label: function(context) {
                            let labelParts = [`Score: ${context.parsed.y}`];
                            let goals = dailyScores[context.dataIndex].daily_run_goals;
                            if (goals && goals.length > 0) {
                                labelParts.push(`Done：${goals.map(goal => goal.title).join(', ')}`);
                            }
                            let diary = dailyScores[context.dataIndex].diary;
                            if (diary) {
                                // ダイアリーのテキストを例えば25文字で折り返す
                                let diaryWrapped = diary.match(/.{1,20}/g) || [];
                                diaryWrapped.forEach(line => {
                                    labelParts.push(line);
                                });
                            }
                            return labelParts; // 配列として返す
                        },
                    },
                },
            },
        },
    };
    let lineChart = new Chart(lineCtx, lineConfig);
</script>
@endsection