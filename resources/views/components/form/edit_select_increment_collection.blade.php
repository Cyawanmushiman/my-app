{{-- selectボックスをボタンで増やせるフォームで、dataにコレクションを設定する --}}
{{--@include('components.form.edit_select_increment_collection', ['name' => '', 'data' => (collection), 'id' => 'id', 'str' => '', 'values' => (array)])--}}
{{--アドバイス：'id'と'str'にはそれぞれテーブルのカラム名を指定してください--}}
{{--
条件：
・追加ボタンのアイコンはFontAwesomeを使っています。
　プロジェクトごとに好きなアイコンに修正してください。
・追加ボタンと削除ボタンの処理は別途JSに記述してください。
　下記のスクリプトを適当なJSに記述すればそのまま使用もできます。
　(下記のスクリプトを使う場合はJqueryを読み込んでください。)

-----------------------------------------------------------------------------------------------------------
// セレクトボックスの追加・削除(商品ジャンルの追加・削除)
$(document).on('click', '.add', function() {
    $(this).closest('.select_increment').clone(true).insertAfter($(this).closest('.select_increment'));
});
$(document).on("click", ".del", function() {
    let target = $('.select_increment');
    if (target.length > 1) {
         $(this).closest('.select_increment').remove();
    }
});
-----------------------------------------------------------------------------------------------------------
--}}


@php
    // コレクションを配列に設定する($idはkeyへ、$strはvalへ設定)
    $arr = $data->mapWithKeys(function ($item) use ($id, $str) {
        return [$item[$id] => $item[$str]];
    });
@endphp

@if(old($name))
    @for($index = 0; $index < count(old($name)); $index++)
        <div class="d-flex my-1 select_increment">
            <select name="{{ $name . '[]' }}" id="{{ $name . $index }}" class="form-control @error($name . '.' . $index) is-invalid @enderror">
                @foreach($arr as $k => $v)
                    <option value="{{ $k }}"
                            @if(old($name . '.' . $index) == $k ) selected @endif>
                        {{ $v }}
                    </option>
                @endforeach
            </select>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary m-1 btn-sm add">
                    <i class="fas fa-plus"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary m-1 btn-sm del">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="text-danger">{{ $errors->first($name . '.' .$index) }}</div>
    @endfor
@else
    @foreach($values as $value)
    <div class="d-flex my-1 select_increment">
        <select name="{{ $name . '[]' }}" id="{{ $name . $loop->index }}" class="form-control @error($name) is-invalid @enderror">
            @foreach($arr as $k => $v)
                <option value="{{ $k }}" @if($value == $k) selected @endif>
                    {{ $v }}
                </option>
            @endforeach
        </select>
        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-outline-secondary m-1 btn-sm add">
                <i class="fas fa-plus"></i>
            </button>
            <button type="button" class="btn btn-outline-secondary m-1 btn-sm del">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    @endforeach
@endif