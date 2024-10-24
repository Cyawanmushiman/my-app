@extends('layouts.user.app')

@section('content')
<style>
    body, html {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover; /* アスペクト比を保ちながら画面全体をカバー */
    }
    
    .overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 5em;
        font-weight: bold;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        z-index: 1; /* 動画の上に表示するため */
    }
    
    
    .home-link {
        position: absolute;
        top: 80%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 1em;
        text-decoration: none;
        z-index: 1;
    }
    
    .reward-link {
        position: absolute;
        top: 70%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 1em;
        text-decoration: none;
        z-index: 1;
    }
</style>
<section class="resume-section">
    <div class="resume-section-content px-5 mt-5">
        <video src="{{ asset('videos/reward.mov') }}" autoplay muted></video>
        
        <div class="overlay">You win!</div>
        <a class="btn btn-info text-white reward-link" href="/">
            <i class="fa-regular fa-gem me-2"></i>GET REWARD
        </a>
        <a class="btn btn-primary text-white home-link" href="{{ route('user.home') }}" id="HOME">
            <i class="fa-solid fa-house me-2"></i>HOME
        </a>
    </div>
</section>
@endsection

@section('script')

@endsection