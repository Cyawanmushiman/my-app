@extends('layouts.user.app')

@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <div class="row mb-5">
            <div class="col-12 mt-3">
                <h2 class="text-center">Achieved consecutive days</h2>
            </div>
            <a href="{{ route('user.purposes.create') }}">purposes</a>
        </div>
    </div>
</section>
@endsection