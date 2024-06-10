{{-- ノード追加 --}}
<button type="button" class="btn  btn-sm btn-outline-dark" id="add_button"><i class="fa-regular fa-square-plus"></i></button>
{{-- ノード編集 --}}
<button type="button" class="btn  btn-sm btn-outline-success" id="edit_button"><i class="fa-regular fa-pen-to-square"></i></button>
{{-- ノード削除 --}}
<button type="button" class="btn  btn-sm btn-outline-danger" id="remove_button"><i class="fa-solid fa-minus"></i></button>
{{-- 更新画面なら表示 --}}
@if (strpos(url()->current(), "/user/mind_maps/") !== false && strpos(url()->current(), "/edit") !== false)
    {{-- マインドマップ更新 --}}
    <button type="button" class="btn  btn-sm btn-primary text-white" id="update_button"><i class="fa-regular fa-floppy-disk"></i></button>
@endif

{{-- 新規登録画面なら表示 --}}
@if (url()->current() === route('user.mind_maps.create'))
    {{-- マインドマップ新規登録 --}}
    <form action="{{ route('user.mind_maps.store') }}" method="post" id="registerMindMap">
        @csrf

        <input type="hidden" id="mindDataJson" name="mind_data_json">
        <button type="button" id="store_button" class="btn btn-sm btn-primary text-white"><i class="fa-regular fa-floppy-disk"></i></button>
    </form>
@endif

{{-- セットアップ画面なら表示 --}}
@if (url()->current() === route('user.set_ups.create_mind_map'))
    {{-- マインドマップ新規登録 --}}
    <form action="{{ route('user.set_ups.store_mind_map') }}" method="post" id="registerMindMap">
        @csrf

        <input type="hidden" id="mindDataJson" name="mind_data_json">
        <button type="submit" id="store_button" class="btn btn-sm btn-primary text-white"><i class="fa-regular fa-floppy-disk"></i></button>
    </form>
@endif

{{-- 画像ノード追加 --}}
<button type="button" class="btn  btn-sm btn-outline-dark" id="add_image_node"><i class="fa-solid fa-code-commit fa-xs"></i><i class="fa-regular fa-image"></i></button>
