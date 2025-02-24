@php
    $inputId = $id ?? $name . '_' . uniqid(); // ユニークなID生成
@endphp

<div class="input-group">
    <input type="password"
        name="{{ $name }}"
        id="{{ $inputId }}"
        class="form-control @error($name) is-invalid @enderror @isset($class) {{ $class }} @endisset"
        @if(old($name)) value="{{ old($name) }}" @endif
        @isset ($required) @if ($required === true) required @endif @endisset
        @isset($placeholder) placeholder="{{ $placeholder }}" @endif
    >

    {{-- パスワード表示/非表示用アイコン --}}
    <span class="input-group-text toggle-password" data-target="{{ $inputId }}" style="cursor: pointer;">
        <i class="fa-solid fa-eye"></i>
    </span>
</div>

{{-- 親bladeファイル内に以下のjsを記述 --}}
{{-- @section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function () {
                const targetInputId = this.dataset.target;
                const input = document.getElementById(targetInputId);

                if (input) {
                    const isPassword = input.type === 'password';
                    input.type = isPassword ? 'text' : 'password';
                    this.innerHTML = isPassword 
                        ? '<i class="fa-solid fa-eye-slash"></i>' 
                        : '<i class="fa-solid fa-eye"></i>';
                }
            });
        });
    });
</script>
@endsection --}}