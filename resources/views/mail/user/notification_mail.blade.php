@extends('layouts.mail.app')
@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <h1 class="h3 border-bottom border-primary border-3 mb-5">MyAppです</h1>
    <div>
        <p>
            {!! $content !!}
        </p>
    </div>
    <div class="mt-5">
        @include('components.parts.mail_footer')
    </div>
</div>
@endsection