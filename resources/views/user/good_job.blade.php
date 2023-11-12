@extends('layouts.user.app')

@section('content')
<div class="container">
    <div class="col-8 mx-auto text-center">
        <img src="{{asset('images/good-job.png')}}" style="max-width:500px;">
    </div>
    <div class="row mb-5">
        <h1 class="text-center">学習お疲れ様でした</h1>
        <div class="col-12 mt-3">
            <h2 class="text-center">現在連続<span class="text-danger">{{ $consecutiveDays }}</span>日!!</h2>
            <h2 class="text-center">この調子で学習していきましょう！</h2>
        </div>
        <div class="col-12 mx-auto text-center mt-3">
            {{-- <a class="twitter-share-button" target="_blank"
            href="https://twitter.com/intent/tweet?text={{ $studyRecord->getTweetMessage() }}%0a&hashtags=ユアスク"
            data-size="large"><i class="fa-brands fa-twitter mr-2"></i><span
                class="twitter-button-text">学習内容をツイート</span></a> --}}
            <a class="twitter-share-button" target="_blank"
            href="https://twitter.com/intent/tweet?text=%0a&hashtags=マイアップ"
            data-size="large"><i class="fa-brands fa-twitter mr-2"></i><span
                class="twitter-button-text">学習内容をツイート</span></a>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-center" style="gap:10px;">
        {{-- <a href="{{ route('user.study_records.index') }}" class="btn c-button01 c-button01--outline mt-3">みんなの学習投稿を見る</a> --}}
        {{-- <a href="{{ route('user.study_records.my_record_list') }}" class="btn c-button01 mt-3">自分の学習投稿を見る</a> --}}
        <a href="" class="btn c-button01 mt-3">自分の学習投稿を見る</a>
    </div>
</div>
@endsection