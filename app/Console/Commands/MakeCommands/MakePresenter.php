<?php

namespace App\Console\Commands\MakeCommands;

use Illuminate\Console\GeneratorCommand;

class MakePresenter extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:presenter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Presenter class';

    /**
     * 生成に使うスタブファイルを取得する
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/presenter.stub';
    }

    /**
     * クラスのデフォルトの名前空間を取得する
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Presenters';
    }
}
