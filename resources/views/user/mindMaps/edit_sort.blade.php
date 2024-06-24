@extends('layouts.user.app')

<style>
    .container ul {
        list-style-type: none;
    }
    .container li {
        cursor: pointer;
        padding: 10px;
        border: solid #ddd 1px;
    }
</style>
@section('content')
<section class="resume-section">
    <div class="resume-section-content">
        <div class="container">
            <x-parts.basic_card_layout>
                <x-slot name="cardHeader">
                    <h4 class="my-2">Sort Mind Map</h4>
                    <a href="{{ route('user.mind_maps.index') }}" class="btn btn-primary text-white">back</a>
                </x-slot>
                <x-slot name="cardBody">
                    <p>※You can sort by drag and drop</p>
                    <draggable v-model="mindMaps" item-key="id" tag="ul">
                        <template #item="{ element }">
                            <li>@{{element.title}}</li>
                        </template>
                    </draggable>
                    <div class="text-center my-4">
                        <p v-if="success" class="text-success">Updated !</p>
                        <button @click="submit" class="btn btn-primary text-white">
                            Update
                        </button>
                    </div>
                </x-slot>
            </x-parts.basic_card_layout>
        </div>
    </div>
</section>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.10.2/Sortable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vuedraggable@4.0.2/dist/vuedraggable.umd.min.js"></script>
<script>
    const draggable = window['vuedraggable'];
    Vue.createApp({
        data() {
            return {
                mindMaps: @json($mindMaps),
                success: false,
            }
        },

        //並び替えたmindMapsを送信する
        methods: {
            submit() {
                axios.post('{{ route('user.mind_maps.update_sort') }}', {
                    mindMaps: this.mindMaps
                }).then(res => {
                    console.log(res);
                    this.success = true;
                    setTimeout(() => {
                        this.success = false}
                        ,2000
                    )
                }).catch(err => {
                    console.log(err);
                    alert('System Error');
                });
            }
        },
        components: {
            draggable: draggable
        },
    }).mount('#container');
    </script>
@endsection



{{-- @extends('layouts.admin.app')
@section('head_style')
<style>
    .container ul {
        list-style-type: none;
    }
    .container li {
        cursor: pointer;
        padding: 10px;
        border: solid #ddd 1px;
    }
</style>
@endsection
@section('content')
    <div class="container">
        <x-parts.basic_card_layout>
            <x-slot name="cardHeader">
                <h4 class="my-2">「{{ $categoryType }}」大カテゴリー並び替え編集画面</h4>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">大カテゴリー一覧へ戻る</a>
            </x-slot>
            <x-slot name="cardBody">
                <p>※ドラッグ&ドロップで並び替えできます</p>
                <p>※「{{ $categoryType }}」内の大カテゴリーを上から順に表示します</p>
                <draggable v-model="categories" item-key="id" tag="ul">
                    <template #item="{ element }">
                        <li>@{{element.name}}</li>
                    </template>
                </draggable>
                <div class="text-center my-4">
                    <p v-if="success" class="text-success">更新しました！</p>
                    <button @click="submit" class="btn btn-primary">
                        並び替え順を更新する
                    </button>
                </div>
            </x-slot>
        </x-parts.basic_card_layout>
    </div>
@endsection 
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.10.2/Sortable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vuedraggable@4.0.2/dist/vuedraggable.umd.min.js"></script>
<script>
const draggable = window['vuedraggable'];
Vue.createApp({
    data() {
        return {
            categories: @json($categories),
            success: false,
        }
    },

    //並び替えたcategoriesを送信する
    methods: {
        submit() {
            axios.post('{{ route('admin.categories.sort_update') }}', {
                categories: this.categories
            }).then(res => {
                console.log(res);
                this.success = true;
                setTimeout(() => {
                    this.success = false}
                    ,2000
                )
            }).catch(err => {
                console.log(err);
                alert('システムエラーが発生しました');
            });
        }
    },
    components: {
        draggable: draggable
    },
}).mount('#main');

</script>
@endsection --}}
