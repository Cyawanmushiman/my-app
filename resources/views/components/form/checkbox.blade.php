{{-- 配列か連想配列で分岐 --}}
@if (array_values($data) === $data)
    @foreach($data as $v)
    <div class="form-check form-check-inline @error($name) is-invalid @enderror">
        <input class="form-check-input"
                type="checkbox"
                name="{{ $name }}"
                id="{{ $name . $loop->iteration }}"
                value="{{ $v }}"
                @isset($checked)
                    @if(old($name, $checked) == $v) checked @endif
                @else
                    @if(old($name) == $v) checked @endif
                @endisset
        >
        <label class="form-check-label" for="{{ $name . $loop->iteration }}">{{ $v }}</label>
    </div>
    @endforeach
@else
    @foreach($data as $k => $v)
    <div class="form-check form-check-inline @error($name) is-invalid @enderror">
        <input class="form-check-input"
            type="checkbox"
            name="{{ $name }}"
            id="{{ $name . $loop->iteration }}"
            value="{{ $k }}"
            @isset($checked)
                @if(old($name, $checked) == $k) checked @endif
            @else
                @if(old($name) == $k) checked @endif
            @endisset
        >
        <label class="form-check-label" for="{{ $name . $loop->iteration }}">{{ $v }}</label>
    </div>
    @endforeach
@endif
