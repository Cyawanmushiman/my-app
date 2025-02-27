@extends('layouts.user.app')

@section('content')
<div class="p-4" style="background-color: #fffaf4;">
    <ul class="progressbar mb-5">
        <li class="complete">First Goal</li>
        <li class="complete">Mind Map</li>
        <li>Daily Goal</li>
    </ul>
    <p>次は簡単にマインドマップを作成してみましょう。<br>
        <small>※マインドマップは後から自由に編集することができます。</small>
    </p>
    <div id="jsmind_container" style="width:100%;height:60vh; background-color: #fffaf4;"></div>
    <div class="d-flex flex-column">
        <p>作成が完了したら<i class="fa-regular fa-floppy-disk ms-1 me-1"></i>をクリックして次に進んでください。</p>
        <div class="d-flex flex-wrap pt-2 ps-3 pe-3 z-3">
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
        <div style="display: none">
            <input class="file" type="file" id="image-chooser" accept="image/*" />
        </div>
        @include('components.parts.mind_maps.expand_image_modal')
    </div>
    @include('components.parts.loading')
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script type="text/javascript">
    function load_jsmind(){
        let deleteImageNames = [];
        let tempImageNames = [];

        const firstGoalText = @json($firstGoalText);
        
        var mind = {
            "meta":{
            },
            "format":"node_array",
            "data":[
                {
                    "id":"root", 
                    "isroot":true, 
                    "topic":firstGoalText,
                    "leading-line-color":"#1abc9c"
                },
            ]
        };

        var options = {
            container:'jsmind_container',
            editable:true,
            theme:'default',
            mode:'side',
            support_html:true,
            view:{
                engine: 'svg',
                node_overflow: 'wrap',
                zoom: {             // 配置缩放
                    min: 0.1,       // 最小的缩放比例
                    max: 1.5,       // 最大的缩放比例
                    step: 0.1,      // 缩放比例间隔
                },
            },
            shortcut:{
                enable:true, 		// whether to enable shortcut
                handles:{
                    'customdelete': function (jm,e){
                        removeNode();
                    },
                    'customAddChild': function (jm,e){
                        addNewNode();
                    },
                    'customAddBrother': function (jm,e){
                        addBrotherNode();
                    },
                }, 			// Named shortcut key event processor
                mapping:{ 			// shortcut key mapping
                    customAddChild : [45, 4096+13], 	// <Insert>, <Ctrl> + <Enter>
                    customAddChild : 9, 	// <Tab>
                    customAddBrother : 13, // <Enter>
                    customdelete : 9, 	// <Delete>
                    customdelete : 8, 	// <Delete>
                    left : 37, 		// <Left>
                    up : 38, 		// <Up>
                    right : 39, 		// <Right>
                    down : 40, 		// <Down>
                }
            },
        };

        // ノードのスタイルを設定
        var jm = new jsMind(options);
        jm.show(mind);
        
        // 拡大・縮小ボタン
        $('#zoomIn').on('click', function() {
            jm.view.zoom_in();;
        });
        $('#zoomOut').on('click', function() {
            jm.view.zoom_out();
        });

        // ボタンをクリックしたら新しいノードを追加
        document.getElementById('add_button').addEventListener('click', addNewNode);
        
        // ボタンをクリックしたら新しい画像ノードを追加
        document.getElementById('add_image_node').addEventListener('click', addImageNode);

        // ボタンをクリックしたら選択したノードを編集
        document.getElementById('edit_button').addEventListener('click', editNode);

        // ボタンをクリックしたら選択したノードを削除
        document.getElementById('remove_button').addEventListener('click', removeNode);
        
        // ボタンをクリックしたらマインドマップを新規保存
        document.getElementById('store_button').addEventListener('click', storeMindMap);

        // ボタンをクリックしたら選択したマインドマップを装飾なしにする
        document.getElementById('chage_air').addEventListener('click', changeColorAir);

        // ボタンをクリックしたら選択したマインドマップをオレンジにする
        document.getElementById('change_orange').addEventListener('click', changeColorOrange);

        // ボタンをクリックしたら選択したマインドマップをデフォルトカラーにする
        document.getElementById('chage_gray').addEventListener('click', changeColorGray);

        // ボタンをクリックしたら選択したマインドマップをブルーにする
        document.getElementById('change_blue').addEventListener('click', changeColorBlue);

        // ボタンをクリックしたら選択したマインドマップのフォントサイズを大きくする
        document.getElementById('change_font_size_large').addEventListener('click', changeFontSizeLarge);

        // ボタンをクリックしたら選択したマインドマップのフォントサイズを標準サイズにする
        document.getElementById('change_font_size_normal').addEventListener('click', changeFontSizeNormal);

        // ボタンをクリックしたら選択したマインドマップのフォントサイズを小さくする
        document.getElementById('change_font_size_small').addEventListener('click', changeFontSizeSmall);
        
        // 初期化時に呼び出し
        initializeDoubleClickEvents();
        
        // 新しいノードを追加する関数
        function addNewNode() {
            var selected_node = jm.get_selected_node(); // 選択されたノードを取得
            if (!selected_node) {
                alert('ノードを選択してください');
                return;
            }
            var nodeid = jsMind.util.uuid.newid(); // 新しいノードのIDを生成
            var topic = '新しいノード ' + nodeid.substr(0, 5); // ノードのトピック
            var data = {
                'leading-line-color': '#787878cf'
            };
            var node = jm.add_node(selected_node, nodeid, topic, data); // ノードを追加
            jm.select_node(nodeid); // 追加したノードを選択
            jm.begin_edit(nodeid); // 追加したノードを編集状態にする
        }
        
        function addBrotherNode() {
            var selected_node = jm.get_selected_node(); // 選択されたノードを取得
            if (!selected_node) {
                alert('ノードを選択してください');
                return;
            }
            var nodeid = jsMind.util.uuid.newid(); // 新しいノードのIDを生成
            var topic = '新しいノード ' + nodeid.substr(0, 5); // ノードのトピック
            var data = {
                'leading-line-color': '#787878cf'
            };
            var node = jm.add_node(selected_node.parent, nodeid, topic, data); // ノードを追加
            jm.select_node(nodeid); // 追加したノードを選択
            jm.begin_edit(nodeid); // 追加したノードを編集状態にする
        }
        
        // 画像ノードを追加する関数
        var imageChooser = document.getElementById('image-chooser');
        // イベントリスナーの設定:ユーザーがファイルを選択した際にこのイベントが発火
        imageChooser.addEventListener(
            'change',
            function (event) {
                // ファイルを非同期で読み込む準備
                var reader = new FileReader();
                
                // // Data URLとして読み込みを開始
                var file = imageChooser.files[0];                   
                if (file) {
                    reader.readAsDataURL(file);
                    
                    // 画像を保存
                    var formData = new FormData();
                    formData.append('image_file', file);
                    axios.post('/api/mindMaps/temp_upload_image', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then((response) => {
                        if(response.data.status === 'success'){
                            let uniqueFileName = response.data.uniqueFileName;
                            tempImageNames.push(uniqueFileName);
                            
                            var selected_node = jm.get_selected_node();
                            var nodeid = 'img-' + uniqueFileName + '-' + jsMind.util.uuid.newid();
                            var topic = undefined;
                            var data = {
                                'background-image': reader.result,
                                'width': '70',
                                'height': '70',
                            };
                            
                            var node = jm.add_node(selected_node, nodeid, topic, data);
                            // ノードが追加された後にDOM要素を取得
                            var addedNodeDom = document.querySelector('jmnode[nodeid="' + nodeid + '"]');         
                            if (addedNodeDom) {
                                // ダブルクリックで画像を表示するイベントリスナーを表示
                                addedNodeDom.addEventListener('dblclick', function(event) {
                                    var addNodeId = event.target.getAttribute('nodeid');
                                    var uniqueFileName = addNodeId.split('-')[1];
                                    var modal = document.getElementById('image-modal');
                                    var modalImg = document.getElementById('modal-image');
                                    modalImg.src = '/storage/images/tempMindMaps/' + uniqueFileName;
                                    
                                    modal.style.display = 'block';
                                });
                            }
                        }
                        else{
                            alert(response.data.message)
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
                }            
                // ファイル入力値をリセットして、同じファイルを再度選択できるようにします。
                imageChooser.value = '';
            },
            false
        );
        function addImageNode() {
            var selected_node = jm.get_selected_node(); // 選択されたノードを取得
            if (!selected_node) {
                alert('ノードを選択してください');
                return;
            }
            
            imageChooser.focus();
            imageChooser.click();
        }
        
        // 選択したノードを編集する関数
        function editNode() {
            var selected_node = jm.get_selected_node(); // 選択されたノードを取得
            if (!selected_node) {
                alert('ノードを選択してください');
                return;
            }
            jm.begin_edit(selected_node); // 選択したノードを編集状態にする
        }
        
        // 選択したノードを削除する関数
        function removeNode() {
            var selected_node = jm.get_selected_node(); // 選択されたノードを取得
            if (!selected_node) {
                alert('ノードを選択してください');
                return;
            }
            // imageノードの場合、画像を削除予定の配列に追加
            if (selected_node.id.startsWith('img-')) {
                var uniqueFileName = selected_node.id.split('-')[1];
                // tempImageNamesに含まれている場合、tempImageNamesから削除
                if (tempImageNames.includes(uniqueFileName)) {
                    tempImageNames = tempImageNames.filter(function(value) {
                        return value !== uniqueFileName;
                    });
                } else {
                    deleteImageNames.push(uniqueFileName);
                }
            }
            
            jm.remove_node(selected_node); // ノードを削除
        }
        
        // マインドマップを保存する関数
        function storeMindMap() {
            // ローディング画面を表示
            document.getElementById('spinner').classList.remove('d-none');
            
            var mindData = jm.get_data(); // マインドマップのデータを取得
            
            var mindDataJson = JSON.stringify(mindData); // マインドマップのデータをJSON形式に変換
            
            // 一時保存した画像ファイル名を送信
            if (tempImageNames.length !== 0) {
                axios.post('/api/mindMaps/upload_images', {
                    params: {
                        temp_image_names: tempImageNames,
                    }
                })
                .then((response) => {
                    if(response.data.status === 'success'){
                        // tempImageNamesを初期化
                        tempImageNames = [];
                        console.log(response.data.message);
                    }
                    else{
                        console.log(response.data.message);
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
            }
            
            // 隠しフィールドにマインドマップのJSONデータをセット
            document.getElementById('mindDataJson').value = mindDataJson;
            document.getElementById('registerMindMap').submit();
        }
        
        // 選択したマインドマップを装飾なしにする関数
        function changeColorAir() {
            var selected_node = jm.get_selected_node(); // 選択されたノードを取得
            if (!selected_node) {
                alert('ノードを選択してください');
                return;
            }
            // 選択したノードの背景色を透明にする
            jm.set_node_color(selected_node.id, '#ffffff', '#333');
        }
        
        // 選択したマインドマップを白色にする関数
        function changeColorOrange() {
            var selected_node = jm.get_selected_node(); // 選択されたノードを取得
            if (!selected_node) {
                alert('ノードを選択してください');
                return;
            }
            // 選択したノードの色を白色にする
            jm.set_node_color(selected_node.id, '#ff9900', '#ffffff');
        }
        
        // 選択したマインドマップをGLAYにする関数
        function changeColorGray() {
            var selected_node = jm.get_selected_node(); // 選択されたノードを取得
            if (!selected_node) {
                alert('ノードを選択してください');
                return;
            }
            // 選択したノードの色を白色にする
            jm.set_node_color(selected_node.id, '#ecf0f1', '#333');
        }
        
        // 選択したマインドマップをブルーにする関数
        function changeColorBlue() {
            var selected_node = jm.get_selected_node(); // 選択されたノードを取得
            if (!selected_node) {
                alert('ノードを選択してください');
                return;
            }
            // 選択したノードの色を白色にする
            jm.set_node_color(selected_node.id, '#3498db', '#ffffff');
        }
        
        // 選択したマインドマップのフォントサイズを大きくする関数
        function changeFontSizeLarge() {
            var selected_node = jm.get_selected_node(); // 選択されたノードを取得
            if (!selected_node) {
                alert('ノードを選択してください');
                return;
            }
            // 選択したノードのフォントサイズを大きくする
            jm.set_node_font_style(selected_node.id, 18.5);
        }
        
        // 選択したマインドマップのフォントサイズを標準サイズにする関数
        function changeFontSizeNormal() {
            var selected_node = jm.get_selected_node(); // 選択されたノードを取得
            if (!selected_node) {
                alert('ノードを選択してください');
                return;
            }
            // 選択したノードのフォントサイズを標準サイズにする
            jm.set_node_font_style(selected_node.id, 16);
        }
        
        // 選択したマインドマップのフォントサイズを小さくする関数
        function changeFontSizeSmall() {
            var selected_node = jm.get_selected_node(); // 選択されたノードを取得
            if (!selected_node) {
                alert('ノードを選択してください');
                return;
            }
            // 選択したノードのフォントサイズを小さくする
            jm.set_node_font_style(selected_node.id, 13.5);
        }
        
        // ダブルクリックで画像を表示する
        function initializeDoubleClickEvents() {
            // nodeidがimg-で始まるnodeを取得（jmnode[nodeid^="img-"]）
            var imgNodes = document.querySelectorAll('jmnode[nodeid^="img-"]');
            imgNodes.forEach(function(imgNode) {
                imgNode.addEventListener('dblclick', function(event) {
                    var addNodeId = event.target.getAttribute('nodeid');
                    var uniqueFileName = addNodeId.split('-')[1];
                    var modal = document.getElementById('image-modal');
                    var modalImg = document.getElementById('modal-image');
                    modalImg.src = '/storage/images/mindMaps/' + uniqueFileName;
                    
                    modal.style.display = 'block';
                });
            });                
        }
        
        // モーダルの閉じるボタンのイベントリスナーを追加
        document.getElementById('close-modal').addEventListener('click', function() {
            var modal = document.getElementById('image-modal');
            modal.style.display = 'none';
        });

        // モーダルの外側をクリックした際に閉じるイベントリスナーを追加
        window.addEventListener('click', function(event) {
            var modal = document.getElementById('image-modal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }); 
    }
    load_jsmind();
</script>
@endsection