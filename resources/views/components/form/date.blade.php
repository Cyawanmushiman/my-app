<input type="date"
   name="{{ $name }}"
    id="{{ $name }}"
    class="form-control
            form-control-date
            @error($name) is-invalid @enderror
            @isset($class) {{ $class }} @endisset
        "
    @isset ($value)
        value="{{ old($name, $value) }}"
    @else
        value="{{ old($name) }}"
    @endisset
    @isset ($required)
        @if ($required === true)
            required
        @endif
    @endisset
    @isset ($placeholder)
        placeholder="{{ $placeholder }}"
    @endif
    @isset ($min)
        min = "{{ $min }}"
    @endif
    @isset ($max)
        max = "{{ $max }}"
    @endif
>
