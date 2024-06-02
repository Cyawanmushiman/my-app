<div class="d-flex flex-wrap pt-2 ps-3 pe-3 z-3 position-fixed bg-white">
    <div class="me-3">
        {{-- 一覧へ戻るボタン --}}
        <a href="{{ route('user.mind_maps.index') }}" class="btn  btn-sm btn-outline-secondary"><i class="fa-solid fa-arrow-left"></i></a>
    </div>
    <div class="me-3 d-flex">
        @include('components.parts.mind_maps.node_control_buttons')
    </div>
    <div class="me-3 d-flex">
        @include('components.parts.mind_maps.node_color_change_buttons')
    </div>
    <div class="me-3 d-flex">
        @include('components.parts.mind_maps.node_size_change_buttons')
    </div>
    <div class="d-flex">
        <div class="btn-group" role="group" aria-label="Basic example">
            @include('components.parts.mind_maps.lupe_buttons')
        </div>
    </div>
</div>