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
        top: 43%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 5em;
        /* no-wrap */
        white-space: nowrap;
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

    .form-container {
        position: absolute;
        top: 65%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        z-index: 1;
        text-align: center;
    }
</style>

<section class="resume-section">
    <div class="resume-section-content px-5 mt-5">
        <video src="{{ asset('videos/game-over.mp4') }}" autoplay muted></video>
        
        <div class="overlay">You lose...</div>

        {{-- リセットの仕様が未確定なので、一旦保留 --}}
        {{-- <div class="form-container">
            <form action="" method="POST">
                @csrf
                
                @foreach (App\Enums\Penalty::cases() as $case)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="option" id="{{ $case }}" value="{{ $case }}" {{ $loop->first ? 'checked' : '' }}>
                        <label class="form-check-label" for="{{ $case }}">
                            {{ $case }}
                        </label>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-light mt-3">Submit</button>
            </form>
        </div> --}}

        <a class="btn btn-primary text-white home-link" href="{{ route('user.home') }}" id="HOME">
            <i class="fa-solid fa-house me-2"></i>HOME
        </a>
    </div>
</section>
@endsection

@section('script')

@endsection
