@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <div class="d-flex mb-5 align-items-center px-4">
            <div class="col-11 position-relative">
                <img src="{{ asset('images/gifs/cat-8915_128.gif') }}" alt="" style="width: 30px; height: 30px; top: -14px; left: 25%" class="position-absolute translate-middle">
                {{-- <div style=
                "width: 15px; 
                height: 15px; 
                background-color: #fff;
                border: 2px solid #bd5d38;
                border-radius: 50%;
                top: 2px;
                left: 105%;
                " class="position-absolute translate-middle"
                ></div> --}}
                <div class="progress" role="progressbar" aria-label="Example 20px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 5px">
                    <div class="progress-bar bg-info" style="width: 25%"></div>
                </div>
            </div>
            <div class="col-1 d-flex justify-content-end">
                <div style=
                "width: 15px; 
                height: 15px; 
                background-color: #fff;
                border: 2px solid #bd5d38;
                border-radius: 50%;
                ">
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary mb-2 mb-md-0" data-bs-toggle="tooltip" data-bs-placement="top" title="上に出るツールチップ">ツールチップ(上)</button>
        {{-- <div class="col-3 mt-3 mb-5">
            海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる海賊になる
        </div> --}}
        <a href="{{ route('user.purposes.create') }}">purposes</a>
    </div>
</section>
@endsection