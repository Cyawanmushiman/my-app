{{-- 例 <x-parts.required_badge class="追加したいクラス名"/> --}}
<span class="badge badge-danger ml-2 @isset($class) {{ $class }} @endisset">必須</span>