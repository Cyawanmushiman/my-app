<?php

namespace App\Enums;

enum DefaultInspire: string
{
    case cup = 'cup';
    case baseball = 'baseball';
    case business = 'business';
    case hat = 'hat';
    case dance = 'dance';
    case running = 'running';
    case soccer = 'soccer';

    public static function getData(): array
    {
        return [
            'cup' => [
                'image_url' => '/images/inspires/cup.svg',
                'comment' => 'コーヒーが冷めないうちに飲むのが一番だね。今のチャンスも同じ。今、君が頑張っていることは、きっと最高のタイミングなんだ。',
            ],
            'baseball' => [
                'image_url' => '/images/inspires/baseball.svg',
                'comment' => 'お前が落ち込むなんて、許せない。失敗したって、それがお前の経験になるんだ。お前はこれからもっとすごいことをやってみせる。俺はお前のことを誇りに思っている。',
            ],
            'business' => [
                'image_url' => '/images/inspires/business.svg',
                'comment' => '成功への道は、自信を持って大胆に歩むことから始まるんだ。君もその一歩を踏み出せば、きっと大きな成果が待っている。恐れずに進もう！',
            ],
            'hat' => [
                'image_url' => '/images/inspires/hat.svg',
                'comment' => '困難に立ち向かうのは勇気がいることです。あなたはその勇気を持っています。だから、諦めないでください。あなたならできます。',
            ],
            'dance' => [
                'image_url' => '/images/inspires/dance.svg',
                'comment' => 'ダンスは止まらない。常に新しいことに挑戦する。',
            ],
            'running' => [
                'image_url' => '/images/inspires/running.svg',
                'comment' => '最後まで諦めない。走り切るのは自分のためだ。',
            ],
            'soccer' => [
                'image_url' => '/images/inspires/soccer.svg',
                'comment' => 'お前たちには止められない！俺のドリブルは最強だ！さあ、シュートだ！ゴールは俺のものだ！',
            ],
        ];
    }
    // case cup = [
    //         'image_url' => '/images/inspires/cup.svg',
    //         'comment' => 'コーヒーが冷めないうちに飲むのが一番だね。今のチャンスも同じ。今、君が頑張っていることは、きっと最高のタイミングなんだ。',
    //     ];
    // case baseball = [
    //         'image_url' => '/images/inspires/baseball.svg',
    //         'comment' => 'お前が落ち込むなんて、許せない。失敗したって、それがお前の経験になるんだ。お前はこれからもっとすごいことをやってみせる。俺はお前のことを誇りに思っている。',
    //     ];
    // case business = [
    //         'image_url' => '/images/inspires/business.svg',
    //         'comment' => '成功への道は、自信を持って大胆に歩むことから始まるんだ。君もその一歩を踏み出せば、きっと大きな成果が待っている。恐れずに進もう！',
    //     ];
    // case hat = [
    //         'image_url' => '/images/inspires/hat.svg',
    //         'comment' => '困難に立ち向かうのは勇気がいることです。あなたはその勇気を持っています。だから、諦めないでください。あなたならできます。',
    //     ];
    // case dance = [
    //         'image_url' => '/images/inspires/dance.svg',
    //         'comment' => 'ダンスは止まらない。常に新しいことに挑戦する。',
    //     ];
    // case running = [
    //         'image_url' => '/images/inspires/running.svg',
    //         'comment' => '最後まで諦めない。走り切るのは自分のためだ。',
    //     ];
    // case soccer = [
    //         'image_url' => '/images/inspires/soccer.svg',
    //         'comment' => 'お前たちには止められない！俺のドリブルは最強だ！さあ、シュートだ！ゴールは俺のものだ！',
    //     ];
}