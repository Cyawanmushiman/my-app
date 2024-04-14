<?php

namespace Tests;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Console\CliDumper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    /**
     * DB のテーブルに入っているデータを出力します
     * MySQL であれば、Laravel6.10 でも大丈夫。
     * SQLite であれば、Laravel 9.9 以上が必要。
     * PostgreSQL13.5、Laravel 9.35 で、ひとまず大丈夫。
     */
    protected function dumpdb(): void
    {
        if (class_exists(CliDumper::class)) {
            CliDumper::resolveDumpSourceUsing(fn () => null); // ファイル名や行数の出力を消す
        }

        foreach (Schema::getAllTables() as $table) {
            if (isset($table->name)) {
                $name = $table->name;
            } else {
                $table = (array) $table;
                $name = reset($table);
            }

            if (in_array($name, ['migrations'], true)) {
                continue;
            }

            $collection = DB::table($name)->get();

            if ($collection->isEmpty()) {
                continue;
            }

            $data = $collection->map(function ($item) {
                unset($item->created_at, $item->updated_at);

                return $item;
            })->toArray();

            dump(sprintf('■■■■■■■■■■■■■■■■■■■ %s %s件 ■■■■■■■■■■■■■■■■■■■', $name, $collection->count()));
            dump($data);
        }

        $this->assertTrue(true);
    }

    /**
     * Dump the database query.
     */
    protected function dumpQuery(): void
    {
        $db = $this->app->make('db');

        $db->enableQueryLog();

        $this->beforeApplicationDestroyed(function () use ($db) {
            dump($db->getQueryLog());
        });
    }
    
    protected function setUp(): void
    {
        fake()->seed(1234);

        parent::setUp();
    }
    
    protected function login($user = null)
    {
        $user ??= User::factory()->create(); // $userがnullの場合、新規ユーザーを作成

        $this->actingAs($user);

        return $user;
    }
}
