{{-- スモールにしたいときは<x-parts.basic_table_layout sm>とする --}}
<div class="table-responsive overflow-auto" style="max-height: 500px;">
    <table class="table table-bordered @isset($sm) table-sm @endisset">
        <thead class="">
            {{ $thead }}
        </thead>
        <tbody style="border-style: none;">
            {{ $tbody }}
        </tbody>
    </table>
</div>