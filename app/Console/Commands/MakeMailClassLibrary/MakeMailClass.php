<?php

namespace App\Console\Commands\MakeMailClassLibrary;

use Illuminate\Console\Command;

class MakeMailClass extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:MakeMailClass {className} {--dirName=} {--withNotify}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'メールクラスと通知クラスを作成するコマンド。';

    protected string $className;

    protected string $snakeClassName;

    protected string $snakeClassNamePlural;

    protected string $camelClassName;

    protected string $camelClassNamePlural;

    protected ?string $dirName;

    protected ?string $snakeDirName;

    protected bool $isNotification;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // パラメータ整形
        $this->className = $this->argument('className');
        $this->snakeClassName = \Str::snake($this->className);
        $this->snakeClassNamePlural = \Str::plural($this->snakeClassName);
        $this->camelClassName = \Str::camel($this->className);
        $this->camelClassNamePlural = \Str::plural($this->camelClassName);
        $this->dirName = $this->option('dirName');
        $this->isNotification = $this->option('withNotify');
        $this->snakeDirName = \Str::snake($this->dirName);

        $this->makeMail();

        if ($this->isNotification) {
            $this->makeNotification();
        }

        // コマンドアウトプット
        $this->output->comment("生成完了！");
        if ($this->isNotification) {
            if($this->dirName) {
                $this->output->comment("通知機能を追加したいファイルに「use App\Notifications\\{$this->dirName}\\{$this->className}」を追記");
            } else {
                {}
                $this->output->comment("通知機能を追加したいファイルに「use App\Notifications\{{ {$this->className} }}」を追記");
            }{}{}
            $this->output->comment("通知箇所に「\${$this->snakeDirName}->notify(new {$this->className}())」を追記");

        } else {
            if ($this->dirName) {
                $this->output->comment("メール機能を追加したいファイルに「use App\Mail\\{$this->dirName}\\{$this->className}」を追記");
            } else {
                {}
                $this->output->comment("メール機能を追加したいファイルに「use App\Mail{{ \$this->className }}}」を追記");
            }{}
            $this->output->comment("メール箇所に「\\Mail::to('送信先アドレス')->send(new {$this->className}())を追記");

        }
        return Command::SUCCESS;
    }

    /**
     * Mailクラス作成
     *
     * @return void
     */
    private function makeMail()
    {
        // スタブファイルの内容を読み込む
        $mailStub = \File::get(app_path() . '/Console/Commands/MakeMailClassLibrary/stubs/mail.stub');

        if ($this->dirName) {
            $mailStub = str_replace(['{{ namespace }}'], 'App\Mail\\' . $this->dirName, $mailStub);
            $mailStub = str_replace(['{{ mailBladeName }}'], "mail.{$this->snakeDirName}.{$this->snakeClassName}", $mailStub);
        } else {
            $mailStub = str_replace(['{{ namespace }}'], 'App\Mail\\', $mailStub);
            $mailStub = str_replace(['{{ mailBladeName }}'], "mail.{$this->snakeClassName}", $mailStub);
        }

        $mailStub = str_replace(['{{ className }}'], $this->className, $mailStub);

        // Mailクラスファイル作成
        $mailClassfilePath = app_path() . '/Mail' . '/';
        if ($this->dirName) {
            $mailClassfilePath = $mailClassfilePath . $this->dirName . '/';
        }

        \File::makeDirectory($mailClassfilePath, 0777, true, true);

        $fileName =  $this->className . '.php';

        \File::put($mailClassfilePath . $fileName, $mailStub);

        // Mail本文ブレードファイル作成
        $mailBladefilePath = resource_path() . '/views/mail/';
        if ($this->dirName) {
            $mailBladefilePath = $mailBladefilePath . $this->snakeDirName . '/';
        }

        \File::makeDirectory($mailBladefilePath, 0777, true, true);

        $mailBladefileName =  $this->snakeClassName . '.blade.php';

        \File::put($mailBladefilePath . $mailBladefileName, '');
    }

    /**
     * Notificationクラス作成
     *
     * @return void
     */
    private function makeNotification()
    {
        // スタブファイルの内容を読み込む
        $notificationStub = \File::get(app_path() . '/Console/Commands/MakeMailClassLibrary/stubs/notification.stub');

        if ($this->dirName) {
            $notificationStub = str_replace(['{{ namespace }}'], 'App\Notifications\\' . $this->dirName, $notificationStub);
            $notificationStub = str_replace(['{{ mailNamespace }}'], 'App\Mail\\' . $this->dirName . '\\' . $this->className, $notificationStub);
        } else {
            $notificationStub = str_replace(['{{ namespace }}'], 'App\Notifications\\', $notificationStub);
            $notificationStub = str_replace(['{{ mailNamespace }}'], 'App\Mail\\' . '\\' . $this->className, $notificationStub);
        }

        $notificationStub = str_replace(['{{ aliasMailClassName }}'], 'Mail' . $this->className, $notificationStub);

        $notificationStub = str_replace(['{{ className }}'], $this->className, $notificationStub);

        // 通知クラスファイル作成
        $notificationClassfilePath = app_path() . '/Notifications' . '/';
        if ($this->dirName) {
            $notificationClassfilePath = $notificationClassfilePath . $this->dirName . '/';
        }

        \File::makeDirectory($notificationClassfilePath, 0777, true, true);

        $fileName =  $this->className . '.php';

        \File::put($notificationClassfilePath . $fileName, $notificationStub);
    }
}
