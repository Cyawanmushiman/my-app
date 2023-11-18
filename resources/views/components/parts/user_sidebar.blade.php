<div class="container-fluid px-5 my-5">
    <div class="row justify-content-center">
        <ul class="list-group list-group-flush accordion" id="accordion">
            <a href="{{ route('user.home') }}" class="list-group-item list-group-item-action"><i class="fas fa-home me-1"></i>ホーム</a>
            <a href="{{ route('user.long_run_goals.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-flag-checkered me-1"></i>長期目標の管理</a>
            <a href="{{ route('user.middle_run_goals.index') }}" class="list-group-item list-group-item-action"><i class="far fa-flag me-1"></i>中期目標の管理</a>
            <a href="{{ route('user.short_run_goals.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-map-marker-alt me-1"></i>短期目標の管理</a>
            <a href="{{ route('user.daily_run_goals.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-map-pin me-1"></i>Daily Goalの管理</a>
            <a href="{{ route('user.inspires.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-comment-dots me-1"></i>インスパイアの管理</a>
        </ul>
    </div>
</div>
