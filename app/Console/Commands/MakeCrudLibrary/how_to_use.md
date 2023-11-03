# MakeCrudLibraryの使い方

## 前提条件
- laravelの初期設定が完了している（DB接続など）
- 共通コードcomponents/form,partsディレクトリをインポートしている
- layoutsにapp.blade.phpを作成している（マルチオースの場合はlayouts/user/app.blade.phpなど）
- app/Console/CommandsにMakeCrudLibraryを設置

## 手順
- php artisan command:MakeCrud  DrinkOrder —dirName=User（任意）
- コマンド成功時に出力される手順を実行する

**※出力される手順は下記となる（一応ここにも記載）**
- migrationファイルに$table->string(‘title’);を追記
- routeファイルにRoute::resource(‘drink_orders', DrinkOrderController::class);などを追記
- php artisan migrate
- /user/drink_order/indexにアクセス
- 完了！CRUDが使える