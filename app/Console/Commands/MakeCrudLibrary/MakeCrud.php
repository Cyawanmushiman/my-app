<?php

namespace App\Console\Commands\MakeCrudLibrary;

use Illuminate\Console\Command;

class MakeCrud extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:MakeCrud {modelName} {--dirName=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '基本CRUDを作成するコマンド';

    protected string $modelName;

    protected string $snakeModelName;

    protected string $snakeModelNamePlural;

    protected string $camelModelName;

    protected string $camelModelNamePlural;

    protected string|null $dirName;

    protected string|null $snakeDirName;
    
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // パラメータ整形
        $this->modelName = $this->argument('modelName');
        $this->snakeModelName = \Str::snake($this->modelName);
        $this->snakeModelNamePlural = \Str::plural($this->snakeModelName);
        $this->camelModelName = \Str::camel($this->modelName);
        $this->camelModelNamePlural = \Str::plural($this->camelModelName);
        $this->dirName = $this->option('dirName');
        $this->snakeDirName = \Str::snake($this->dirName);

        // モデル作成
        \Artisan::call("make:model {$this->modelName} -fm");
        // モデルに「protected $guarded = [];」を追記
        $this->appendGuardedToModel();

        // コントローラー作成
        $this->makeController();

        // リクエスト作成
        $this->makeRequest();
        
        // ブレード作成
        // index
        $this->makeIndexBlade();
        // create
        $this->makeCreateBlade();
        // show
        $this->makeShowBlade();
        // edit
        $this->makeEditBlade();

        // コマンドアウトプット
        $this->components->info("生成完了！");
        // $this->output->comment('モデルに「protected $guarded = [];」を追記'); // 自動化したのでコメントアウト
        $this->output->comment("migrationファイルに「\$table->string('title');」を追記");
        $this->output->comment("routeファイルに「Route::resource('{$this->snakeModelNamePlural}', {$this->modelName}Controller::class);」を追記");
        $this->output->comment("「php artisan migrate」を実行");
        if ($this->dirName) {
            $this->output->comment("「/{$this->snakeDirName}/{$this->snakeModelNamePlural}」にアクセス");
        } else {
            $this->output->comment("「/{$this->snakeModelNamePlural}」にアクセス");
        }
        $this->output->comment("完了！CRUDが使える");

    }

    // モデルに「protected $guarded = [];」を追記
    protected function appendGuardedToModel(): void
    {
        $modelPath = app_path("Models/{$this->modelName}.php");
        $modelContents = \File::get($modelPath);
    
        // ファイルの内容を行ごとに配列として取得
        $lines = explode("\n", $modelContents);
    
        // 下から3行目に`protected $guarded = [];`を追加し、その上に1行の改行を追加
        array_splice($lines, -2, 0, ["", "    protected \$guarded = [];"]);
    
        // 配列を文字列に戻してファイルに保存
        $updatedContents = implode("\n", $lines);
        \File::put($modelPath, $updatedContents);
    }

    /**
     * Controller作成
     *
     * @return void
     */
    public function makeController()
    {
        // スタブファイルの内容を読み込む
        $controllerStub = \File::get(app_path() . '/Console/Commands/MakeCrudLibrary/stubs/crud_controller.stub');

        // 〜スタブファイルに対して置換などの加工処理などを行う
        if ($this->dirName) {
            $controllerStub = str_replace(['{{ namespace }}'], 'App\Http\Controllers\\' . $this->dirName, $controllerStub);
            $controllerStub = str_replace(['{{ requestNamespace }}'], 'App\Http\Requests\\' . $this->dirName . '\\' . $this->modelName . 'Controller', $controllerStub);
            $controllerStub = str_replace(['{{ indexViewName }}'], "{$this->snakeDirName}.{$this->snakeModelNamePlural}.index", $controllerStub);
            $controllerStub = str_replace(['{{ createViewName }}'], "{$this->snakeDirName}.{$this->snakeModelNamePlural}.create", $controllerStub);
            $controllerStub = str_replace(['{{ showViewName }}'], "{$this->snakeDirName}.{$this->snakeModelNamePlural}.show", $controllerStub);
            $controllerStub = str_replace(['{{ editViewName }}'], "{$this->snakeDirName}.{$this->snakeModelNamePlural}.edit", $controllerStub);
        } else {
            $controllerStub = str_replace(['{{ namespace }}'], "App\Http\Controllers", $controllerStub);
            $controllerStub = str_replace(['{{ requestNamespace }}'], 'App\Http\Requests\\' . $this->modelName . 'Controller', $controllerStub);
            $controllerStub = str_replace(['{{ indexViewName }}'], "{$this->snakeModelNamePlural}.index", $controllerStub);
            $controllerStub = str_replace(['{{ createViewName }}'], "{$this->snakeModelNamePlural}.create", $controllerStub);
            $controllerStub = str_replace(['{{ showViewName }}'], "{$this->snakeModelNamePlural}.show", $controllerStub);
            $controllerStub = str_replace(['{{ editViewName }}'], "{$this->snakeModelNamePlural}.edit", $controllerStub);
        }
        $controllerStub = str_replace(['{{ modelName }}'], $this->modelName, $controllerStub);
        $controllerStub = str_replace(['{{ camelModelName }}'], $this->camelModelName, $controllerStub);
        $controllerStub = str_replace(['{{ camelModelNamePlural }}'], $this->camelModelNamePlural, $controllerStub);

        // ファイルのパス
        $filePath = app_path() . '/Http/Controllers' . '/';
        if ($this->dirName) {
            $filePath = $filePath . $this->dirName . '/';
        }

        // ディレクトリ作成
        \File::makeDirectory($filePath, 0777, true, true);

        // ファイル名
        $fileName =  $this->modelName . 'Controller.php';

        // ファイルを作成
        \File::put($filePath . $fileName, $controllerStub);
    }

    /**
     * FormRequest作成
     *
     * @return void
     */
    public function makeRequest()
    {
        // ファイルのパス
        $filePath = app_path() . '/Http/Requests' . '/';
        if ($this->dirName) {
            $filePath = $filePath . $this->dirName . '/' . $this->modelName . 'Controller' . '/';
        } else {
            $filePath = $filePath . '/' . $this->modelName . 'Controller' . '/';
        }
        
        /**
         * StoreRequest作成
         */
        
        // スタブファイルの内容を読み込む  
        $requestStub = \File::get(app_path() . '/Console/Commands/MakeCrudLibrary/stubs/request.stub');

        // 〜スタブファイルに対して置換などの加工処理などを行う
        if ($this->dirName) {
            $requestStub = str_replace(['{{ namespace }}'], 'App\Http\Requests\\' . $this->dirName . '\\' . $this->modelName . 'Controller', $requestStub);
        } else {
            $requestStub = str_replace(['{{ namespace }}'], "App\Http\Requests\\" . $this->modelName . 'Controller', $requestStub);
        }
        $requestStub = str_replace(['{{ class }}'], 'StoreRequest', $requestStub);
        
        // ディレクトリ作成
        \File::makeDirectory($filePath, 0777, true, true);

        // ファイル名
        $fileName =  'StoreRequest.php';
        
        // ファイルを作成
        \File::put($filePath . $fileName, $requestStub);

        /**
         * UpdateRequest作成
         */

        // スタブファイルの内容を読み込む  
        $updateRequestStub = \File::get(app_path() . '/Console/Commands/MakeCrudLibrary/stubs/request.stub');

        // 〜スタブファイルに対して置換などの加工処理などを行う
        if ($this->dirName) {
            $updateRequestStub = str_replace(['{{ namespace }}'], 'App\Http\Requests\\' . $this->dirName . '\\' . $this->modelName . 'Controller', $updateRequestStub);
        } else {
            $updateRequestStub = str_replace(['{{ namespace }}'], "App\Http\Requests\\" . $this->modelName . 'Controller', $updateRequestStub);
        }
        $updateRequestStub = str_replace(['{{ class }}'], 'UpdateRequest', $updateRequestStub);

        // ファイル名
        $fileName =  'UpdateRequest.php';

        // ファイル作成
        \File::put($filePath . $fileName, $updateRequestStub);
    }

    /**
     * indexブレード作成
     *
     * @return void
     */
    public function makeIndexBlade()
    {
        // スタブファイルの内容を読み込む
        $indexBladeStub = \File::get(app_path() . '/Console/Commands/MakeCrudLibrary/stubs/index_blade.stub');

        // 〜スタブファイルに対して置換などの加工処理などを行う
        if ($this->dirName) {
            $extends = "layouts.{$this->snakeDirName}.app";
            $createAction = "{$this->snakeDirName}.{$this->snakeModelNamePlural}.create";
            $showAction = "{$this->snakeDirName}.{$this->snakeModelNamePlural}.show";
            $editAction = "{$this->snakeDirName}.{$this->snakeModelNamePlural}.edit";
            $destroyAction = "{$this->snakeDirName}.{$this->snakeModelNamePlural}.destroy";
        } else {
            $extends = "layouts.app";
            $createAction = "{$this->snakeModelNamePlural}.create";
            $showAction = "{$this->snakeModelNamePlural}.show";
            $editAction = "{$this->snakeModelNamePlural}.edit";
            $destroyAction = "{$this->snakeModelNamePlural}.destroy";
        }
        $indexBladeStub = str_replace(['{{ extends }}'], $extends, $indexBladeStub);
        $indexBladeStub = str_replace(['{{ showAction }}'], $showAction, $indexBladeStub);
        $indexBladeStub = str_replace(['{{ createAction }}'], $createAction, $indexBladeStub);
        $indexBladeStub = str_replace(['{{ editAction }}'], $editAction, $indexBladeStub);
        $indexBladeStub = str_replace(['{{ destroyAction }}'], $destroyAction, $indexBladeStub);
        $indexBladeStub = str_replace(['{{ modelNamePlural }}'], $this->camelModelNamePlural, $indexBladeStub);
        $indexBladeStub = str_replace(['{{ modelName }}'], $this->camelModelName, $indexBladeStub);

        // ファイルのパス
        $filePath = $this->makeBladeDir();

        // ファイル名
        $fileName = 'index.blade.php';

        // ファイルを作成
        \File::put($filePath . $fileName, $indexBladeStub);
    }

    /**
     * createブレード作成
     *
     * @return void
     */
    public function makeCreateBlade()
    {
        // スタブファイルの内容を読み込む
        $createBladeStub = \File::get(app_path() . '/Console/Commands/MakeCrudLibrary/stubs/create_blade.stub');
        
        // 〜スタブファイルに対して置換などの加工処理などを行う
        if ($this->dirName) {
            $extends = "layouts.{$this->snakeDirName}.app";
            $action = "{$this->snakeDirName}.{$this->snakeModelNamePlural}.store";
        } else {
            $extends = "layouts.app";
            $action = "{$this->snakeModelNamePlural}.store";
        }
        $createBladeStub = str_replace(['{{ extends }}'], $extends, $createBladeStub);
        $createBladeStub = str_replace(['{{ action }}'], $action, $createBladeStub);

        // ファイルのパス
        $filePath = $this->makeBladeDir();

        // ファイル名
        $fileName = 'create.blade.php';

        \File::put($filePath . $fileName, $createBladeStub);
    }

    /**
     * showブレード作成
     *
     * @return void
     */
    public function makeShowBlade()
    {
        // スタブファイルの内容を読み込む
        $showBladeStub = \File::get(app_path() . '/Console/Commands/MakeCrudLibrary/stubs/show_blade.stub');
        
        // 〜スタブファイルに対して置換などの加工処理などを行う
        if ($this->dirName) {
            $extends = "layouts.{$this->snakeDirName}.app";
        } else {
            $extends = "layouts.app";
        }
        $showBladeStub = str_replace(['{{ extends }}'], $extends, $showBladeStub);
        $showBladeStub = str_replace(['{{ camelModelName }}'], $this->camelModelName, $showBladeStub);

        // ファイルのパス
        $filePath = $this->makeBladeDir();

        // ファイル名
        $fileName = 'show.blade.php';

        \File::put($filePath . $fileName, $showBladeStub);
    }

    /**
     * editブレード作成
     *
     * @return void
     */
    public function makeEditBlade()
    {
        // スタブファイルの内容を読み込む
        $editBladeStub = \File::get(app_path() . '/Console/Commands/MakeCrudLibrary/stubs/edit_blade.stub');

        // 〜スタブファイルに対して置換などの加工処理などを行う
        if ($this->dirName) {
            $extends = "layouts.{$this->snakeDirName}.app";
            $action = "{$this->snakeDirName}.{$this->snakeModelNamePlural}.update";
        } else {
            $extends = "layouts.app";
            $action = "{$this->snakeModelNamePlural}.update";
        }
        $editBladeStub = str_replace(['{{ extends }}'], $extends, $editBladeStub);
        $editBladeStub = str_replace(['{{ action }}'], $action, $editBladeStub);
        $editBladeStub = str_replace(['{{ modelName }}'], $this->camelModelName, $editBladeStub);

        // ファイルのパス
        $filePath = $this->makeBladeDir();

        // ファイル名
        $fileName = 'edit.blade.php';

        // ファイルを作成
        \File::put($filePath . $fileName, $editBladeStub);
    }

    /**
     * Bladeファイルのディレクトリ作成
     *
     * @return string
     */
    public function makeBladeDir()
    {
        // ファイルのパス
        if ($this->dirName) {
            $filePath = resource_path() . '/views' . '/' . $this->snakeDirName . '/' . $this->snakeModelNamePlural . '/';
        } else {
            $filePath = resource_path() . '/views' . '/' . $this->snakeModelNamePlural . '/';
        }
        // ディレクトリ作成
        \File::makeDirectory($filePath, 0777, true, true);

        return $filePath;
    }
}
