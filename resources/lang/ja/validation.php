<?php

declare(strict_types=1);

return [
    'accepted'             => ':Attributeを承認してください。',
    'accepted_if'          => ':Otherが:valueの場合、:attributeを承認する必要があります。',
    'active_url'           => ':Attributeは、有効なURLではありません。',
    'after'                => ':Attributeには、:dateより後の日付を指定してください。',
    'after_or_equal'       => ':Attributeには、:date以降の日付を指定してください。',
    'alpha'                => ':Attributeには、アルファベッドのみ使用できます。',
    'alpha_dash'           => ':Attributeには、英数字(\'A-Z\',\'a-z\',\'0-9\')とハイフンと下線(\'-\',\'_\')が使用できます。',
    'alpha_num'            => ':Attributeには、英数字(\'A-Z\',\'a-z\',\'0-9\')が使用できます。',
    'array'                => ':Attributeには、配列を指定してください。',
    'ascii'                => ':Attributeには、英数字と記号のみ使用可能です。',
    'before'               => ':Attributeには、:dateより前の日付を指定してください。',
    'before_or_equal'      => ':Attributeには、:date以前の日付を指定してください。',
    'between'              => [
        'array'   => ':Attributeの項目は、:min個から:max個にしてください。',
        'file'    => ':Attributeには、:min KBから:max KBまでのサイズのファイルを指定してください。',
        'numeric' => ':Attributeには、:minから、:maxまでの数字を指定してください。',
        'string'  => ':Attributeは、:min文字から:max文字にしてください。',
    ],
    'boolean'              => ':Attributeには、\'true\'か\'false\'を指定してください。',
    'can'                  => ':Attribute フィールドには不正な値が含まれています。',
    'confirmed'            => ':Attributeと:attribute確認が一致しません。',
    'current_password'     => 'パスワードが正しくありません。',
    'date'                 => ':Attributeは、正しい日付ではありません。',
    'date_equals'          => ':Attributeは:dateと同じ日付を入力してください。',
    'date_format'          => ':Attributeの形式が\':format\'と一致しません。',
    'decimal'              => ':Attributeは、小数点以下が:decimalである必要があります。',
    'declined'             => ':Attributeを拒否する必要があります。',
    'declined_if'          => ':Otherが:valueの場合、:attributeを拒否する必要があります。',
    'different'            => ':Attributeと:otherには、異なるものを指定してください。',
    'digits'               => ':Attributeは、:digits桁にしてください。',
    'digits_between'       => ':Attributeは、:min桁から:max桁にしてください。',
    'dimensions'           => ':Attributeの画像サイズが無効です',
    'distinct'             => ':Attributeの値が重複しています。',
    'doesnt_end_with'      => ':Attributeの終わりは「:values」以外である必要があります。',
    'doesnt_start_with'    => ':Attributeの始まりは「:values」以外である必要があります。',
    'email'                => ':Attributeは、有効なメールアドレス形式で指定してください。',
    'ends_with'            => ':Attributeの終わりは「:values」である必要があります。',
    'enum'                 => '選択した :attributeは 無効です。',
    'exists'               => '選択された:attributeは、有効ではありません。',
    'file'                 => ':Attributeには、ファイル形式を指定してください。',
    'filled'               => ':Attributeは必須です。',
    'gt'                   => [
        'array'   => ':Attributeの項目数は、:value個より多い必要があります。',
        'file'    => ':Attributeは、:value KBより大きい必要があります。',
        'numeric' => ':Attributeは、:valueより大きい必要があります。',
        'string'  => ':Attributeは、:value文字を超える必要があります。',
    ],
    'gte'                  => [
        'array'   => ':Attributeの項目数は、:value個以上である必要があります。',
        'file'    => ':Attributeは、:value KB以上である必要があります。',
        'numeric' => ':Attributeは、:value以上である必要があります。',
        'string'  => ':Attributeは、:value文字以上である必要があります。',
    ],
    'image'                => ':Attributeには、画像を指定してください。',
    'in'                   => '選択された:attributeは、有効ではありません。',
    'in_array'             => ':Attributeが:otherに存在しません。',
    'integer'              => ':Attributeには、整数を指定してください。',
    'ip'                   => ':Attributeには、有効なIPアドレスを指定してください。',
    'ipv4'                 => ':AttributeはIPv4アドレスを指定してください。',
    'ipv6'                 => ':AttributeはIPv6アドレスを指定してください。',
    'json'                 => ':Attributeには、有効なJSON文字列を指定してください。',
    'lowercase'            => ':Attributeは、小文字で入力してください。',
    'lt'                   => [
        'array'   => ':Attributeの項目数は、:value個より少ない必要があります。',
        'file'    => ':Attributeは、:value KBより小さい必要があります。',
        'numeric' => ':Attributeは、:valueより小さい必要があります。',
        'string'  => ':Attributeは、:value文字より小さい必要があります。',
    ],
    'lte'                  => [
        'array'   => ':Attributeの項目数は、:value個以下である必要があります。',
        'file'    => ':Attributeは、:value KB以下である必要があります。',
        'numeric' => ':Attributeは、:value以下である必要があります。',
        'string'  => ':Attributeは、:value文字以下である必要があります。',
    ],
    'mac_address'          => ':Attributeは有効なMACアドレスである必要があります。',
    'max'                  => [
        'array'   => ':Attributeの項目数は、:max個以下である必要があります。',
        'file'    => ':Attributeは、:max KB以下のファイルである必要があります。',
        'numeric' => ':Attributeは、:max以下の数字である必要があります。',
        'string'  => ':Attributeの文字数は、:max文字以下である必要があります。',
    ],
    'max_digits'           => ':Attributeは、:max桁以下の数字である必要があります。',
    'mimes'                => ':Attributeには、以下のファイルタイプを指定してください。:values',
    'mimetypes'            => ':Attributeには、以下のファイルタイプを指定してください。:values',
    'min'                  => [
        'array'   => ':Attributeの項目数は、:min個以上にしてください。',
        'file'    => ':Attributeには、:min KB以上のファイルを指定してください。',
        'numeric' => ':Attributeには、:min以上の数字を指定してください。',
        'string'  => ':Attributeの文字数は、:min文字以上である必要があります。',
    ],
    'min_digits'           => ':Attributeは、:min桁以上の数字である必要があります。',
    'missing'              => ':Attribute を入力する必要はありません。',
    'missing_if'           => ':Other が :value の場合、:attribute を入力する必要はありません。',
    'missing_unless'       => ':Other が :value でない限り、:attribute をは入力する必要はありません。',
    'missing_with'         => ':Values が存在する場合、:attribute をは入力する必要はありません。',
    'missing_with_all'     => ':Values が存在する場合、:attribute をは入力する必要はありません。',
    'multiple_of'          => ':Attributeは:valueの倍数である必要があります',
    'not_in'               => '選択された:attributeは、有効ではありません。',
    'not_regex'            => ':Attributeの形式が正しくありません。',
    'numeric'              => ':Attributeには、数字を指定してください。',
    'password'             => [
        'letters'       => ':Attributeは文字を1文字以上含める必要があります。',
        'mixed'         => ':Attributeは大文字と小文字をそれぞれ1文字以上含める必要があります。',
        'numbers'       => ':Attributeは数字を1文字以上含める必要があります。',
        'symbols'       => ':Attributeは記号を1文字以上含める必要があります。',
        'uncompromised' => ':Attributeは情報漏洩した可能性があります。他の:attributeを選択してください。',
    ],
    'present'              => ':Attributeが存在している必要があります。',
    'prohibited'           => ':Attributeの入力は禁止されています。',
    'prohibited_if'        => ':Otherが:valueの場合は、:Attributeの入力が禁止されています。',
    'prohibited_unless'    => ':Otherが:valuesでない限り、:Attributeの入力は禁止されています。',
    'prohibits'            => ':Otherが存在している場合、:Attributeの入力は禁止されています。',
    'regex'                => ':Attributeには、正しい形式を指定してください。',
    'required'             => ':Attributeは必須項目です。',
    'required_array_keys'  => ':Attributeには、:valuesのエントリを含める必要があります。',
    'required_if'          => ':Otherが:valueの場合、:attributeを指定してください。',
    'required_if_accepted' => ':Otherを承認した場合、:attributeは必須項目です。',
    'required_unless'      => ':Otherが:values以外の場合、:attributeは必須項目です。',
    'required_with'        => ':Valuesが入力されている場合、:attributeは必須項目です。',
    'required_with_all'    => ':Valuesが全て指定されている場合、:attributeは必須項目です。',
    'required_without'     => ':Valuesが入力されていない場合、:attributeは必須項目です。',
    'required_without_all' => ':Valuesが全て指定されていない場合、:attributeを指定してください。',
    'same'                 => ':Attributeと:otherが一致しません。',
    'size'                 => [
        'array'   => ':Attributeの項目数は、:size個にしてください。',
        'file'    => ':Attributeには、:size KBのファイルを指定してください。',
        'numeric' => ':Attributeには、:sizeを指定してください。',
        'string'  => ':Attributeの文字数は、:size文字にしてください。',
    ],
    'starts_with'          => ':Attributeは、次のいずれかで始まる必要があります。:values',
    'string'               => ':Attributeには、文字列を指定してください。',
    'timezone'             => ':Attributeには、有効なタイムゾーンを指定してください。',
    'ulid'                 => ':Attributeは、有効なULIDである必要があります。',
    'unique'               => '指定の:attributeは既に使用されています。',
    'uploaded'             => ':Attributeのアップロードに失敗しました。',
    'uppercase'            => ':Attributeは、大文字で入力してください。',
    'url'                  => ':Attributeは、有効なURL形式で指定してください。',
    'uuid'                 => ':Attributeは、有効なUUIDである必要があります。',

    
    /*
    |--------------------------------------------------------------------------
    | Custom バリデーション言語行
    |--------------------------------------------------------------------------
    |
    | "属性.ルール"の規約でキーを指定することでカスタムバリデーション
    | メッセージを定義できます。指定した属性ルールに対する特定の
    | カスタム言語行を手早く指定できます。
    |
    */
    'custom' => [
        'Monday-content' => [
            'required' => '月曜日のcontentは必須です。',
        ],
        'Monday-action_time' => [
            'required' => '月曜日のtimeは必須です。',
        ],
        'Monday-methods' => [
            'required' => '月曜日のmethodsは必須です。',
        ],
        'Tuesday-content' => [
            'required' => '火曜日のcontentは必須です。',
        ],
        'Tuesday-action_time' => [
            'required' => '火曜日のtimeは必須です。',
        ],
        'Tuesday-methods' => [
            'required' => '火曜日のmethodsは必須です。',
        ],
        'Wednesday-content' => [
            'required' => '水曜日のcontentは必須です。',
        ],
        'Wednesday-action_time' => [
            'required' => '水曜日のtimeは必須です。',
        ],
        'Wednesday-methods' => [
            'required' => '水曜日のmethodsは必須です。',
        ],
        'Thursday-content' => [
            'required' => '木曜日のcontentは必須です。',
        ],
        'Thursday-action_time' => [
            'required' => '木曜日のtimeは必須です。',
        ],
        'Thursday-methods' => [
            'required' => '木曜日のmethodsは必須です。',
        ],
        'Friday-content' => [
            'required' => '金曜日のcontentは必須です。',
        ],
        'Friday-action_time' => [
            'required' => '金曜日のtimeは必須です。',
        ],
        'Friday-methods' => [
            'required' => '金曜日のmethodsは必須です。',
        ],
        'Saturday-content' => [
            'required' => '土曜日のcontentは必須です。',
        ],
        'Saturday-action_time' => [
            'required' => '土曜日のtimeは必須です。',
        ],
        'Saturday-methods' => [
            'required' => '土曜日のmethodsは必須です。',
        ],
        'Sunday-content' => [
            'required' => '日曜日のcontentは必須です。',
        ],
        'Sunday-action_time' => [
            'required' => '日曜日のtimeは必須です。',
        ],
        'Sunday-methods' => [
            'required' => '日曜日のmethodsは必須です。',
        ],
        
        'daily_run_goal_ids' => [
            'required' => '何か一つはやらないと登録できないよ？？',
        ],
    ],
    
    /*
    |--------------------------------------------------------------------------
    | カスタムバリデーション属性名
    |--------------------------------------------------------------------------
    |
    | 以下の言語行は、例えば"email"の代わりに「メールアドレス」のように、
    | 読み手にフレンドリーな表現でプレースホルダーを置き換えるために指定する
    | 言語行です。これはメッセージをよりきれいに表示するために役に立ちます。
    |
    */
    
    'attributes' => [
        'title' => 'title',
        'content' => 'content',
        'shcedule_on' => 'schedule',
        'start_on' => 'start date',
        'finish_on' => 'finish date',
    ],
];