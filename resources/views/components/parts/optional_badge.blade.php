{{-- 例 <x-parts.optional_badge class="追加したいクラス名"/> --}}

<span class="badge badge-secondary m-2 @isset($class) {{ $class }} @endisset">任意</span>
