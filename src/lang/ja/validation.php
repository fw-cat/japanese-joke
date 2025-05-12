<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attributeフィールドは受け入れられる必要があります。',
    'accepted_if' => ':otherが:valueの場合、:attributeフィールドは受け入れられる必要があります。',
    'active_url' => ':attributeフィールドは有効なURLである必要があります。',
    'after' => ':attributeフィールドは:date以降の日付である必要があります。',
    'after_or_equal' => ':attributeフィールドは:date以降またはその日付である必要があります。',
    'alpha' => ':attributeフィールドは文字のみを含める必要があります。',
    'alpha_dash' => ':attributeフィールドは文字、数字、ダッシュ、アンダースコアのみを含める必要があります。',
    'alpha_num' => ':attributeフィールドは文字と数字のみを含める必要があります。',
    'array' => ':attributeフィールドは配列である必要があります。',
    'ascii' => ':attributeフィールドは半角英数字と記号のみを含める必要があります。',
    'before' => ':attributeフィールドは:date以前の日付である必要があります。',
    'before_or_equal' => ':attributeフィールドは:date以前またはその日付である必要があります。',
    'between' => [
        'array' => ':attributeフィールドの項目数は:min～:max個の間である必要があります。',
        'file' => ':attributeフィールドは:min～:maxキロバイトの間である必要があります。',
        'numeric' => ':attributeフィールドは:min～:maxの間である必要があります。',
        'string' => ':attributeフィールドは:min～:max文字の間である必要があります。',
    ],
    'boolean' => ':attributeフィールドは真偽値(true/false)である必要があります。',
    'can' => ':attributeフィールドには承認されていない値が含まれています。',
    'confirmed' => ':attributeフィールドが確認値と一致しません。',
    'contains' => ':attributeフィールドに必須の値が含まれていません。',
    'current_password' => 'パスワードが正しくありません。',
    'date' => ':attributeフィールドは有効な日付である必要があります。',
    'date_equals' => ':attributeフィールドは:dateに等しい日付である必要があります。',
    'date_format' => ':attributeフィールドは:format形式と一致する必要があります。',
    'decimal' => ':attributeフィールドは:decimal桁の小数点以下の数値を含める必要があります。',
    'declined' => ':attributeフィールドは拒否される必要があります。',
    'declined_if' => ':otherが:valueの場合、:attributeフィールドは拒否される必要があります。',
    'different' => ':attributeフィールドと:otherは異なる値である必要があります。',
    'digits' => ':attributeフィールドは:digits桁の数値である必要があります。',
    'digits_between' => ':attributeフィールドは:min桁から:max桁の間の数値である必要があります。',
    'dimensions' => ':attributeフィールドの画像サイズが無効です。',
    'distinct' => ':attributeフィールドに重複した値があります。',
    'doesnt_end_with' => ':attributeフィールドは次のうちいずれかで終わってはいけません: :values。',
    'doesnt_start_with' => ':attributeフィールドは次のうちいずれかで始まってはいけません: :values。',
    'email' => ':attributeフィールドは有効なメールアドレスである必要があります。',
    'ends_with' => ':attributeフィールドは次のうちいずれかで終わる必要があります: :values。',
    'enum' => '選択された:attributeは無効です。',
    'exists' => '選択された:attributeは無効です。',
    'extensions' => ':attributeフィールドのファイル拡張子は次のいずれかである必要があります: :values。',
    'file' => ':attributeフィールドはファイルである必要があります。',
    'filled' => ':attributeフィールドには値が入力されている必要があります。',
    'gt' => [
        'array' => ':attributeフィールドの項目数は:value個より多い必要があります。',
        'file' => ':attributeフィールドは:valueキロバイトより大きい必要があります。',
        'numeric' => ':attributeフィールドは:valueより大きい必要があります。',
        'string' => ':attributeフィールドは:value文字より多い必要があります。',
    ],
    'gte' => [
        'array' => ':attributeフィールドの項目数は:value個以上である必要があります。',
        'file' => ':attributeフィールドは:value キロバイト以上である必要があります。',
        'numeric' => ':attributeフィールドは:value以上である必要があります。',
        'string' => ':attributeフィールドは:value文字以上である必要があります。',
    ],
    'hex_color' => ':attributeフィールドは有効な16進数カラーコードである必要があります。',
    'image' => ':attributeフィールドは画像である必要があります。',
    'in' => '選択された:attributeは無効です。',
    'in_array' => ':attributeフィールドの値は:otherに存在する必要があります。',
    'integer' => ':attributeフィールドは整数である必要があります。',
    'ip' => ':attributeフィールドは有効なIPアドレスである必要があります。',
    'ipv4' => ':attributeフィールドは有効なIPv4アドレスである必要があります。',
    'ipv6' => ':attributeフィールドは有効なIPv6アドレスである必要があります。',
    'json' => ':attributeフィールドは有効なJSON文字列である必要があります。',
    'list' => ':attributeフィールドはリストである必要があります。',
    'lowercase' => ':attributeフィールドは小文字である必要があります。',
    'lt' => [
        'array' => ':attributeフィールドの項目数は:value個未満である必要があります。',
        'file' => ':attributeフィールドは:valueキロバイト未満である必要があります。',
        'numeric' => ':attributeフィールドは:value未満である必要があります。',
        'string' => ':attributeフィールドは:value文字未満である必要があります',
    ],
    'lte' => [
        'array' => ':attributeフィールドの項目数は:value個以下である必要があります。',
        'file' => ':attributeフィールドは:valueキロバイト以下である必要があります。',
        'numeric' => ':attributeフィールドは:value以下である必要があります。',
        'string' => ':attributeフィールドは:value文字以下である必要があります。',
    ],
    'mac_address' => ':attributeフィールドは有効なMACアドレスである必要があります。',
    'max' => [
        'array' => ':attributeフィールドの項目数は:max個以下である必要があります。',
        'file' => ':attributeフィールドは:maxキロバイト以下である必要があります。',
        'numeric' => ':attributeフィールドは:max以下である必要があります。',
        'string' => ':attributeフィールドは:max文字以下である必要があります。',
    ],
    'max_digits' => ':attributeフィールドは:max桁以下の数値である必要があります。',
    'mimes' => ':attributeフィールドのファイル形式は次のいずれかである必要があります: :values。',
    'mimetypes' => ':attributeフィールドのファイルタイプは次のいずれかである必要があります: :values。', 
    'min' => [
        'array' => ':attributeフィールドの項目数は:min個以上である必要があります。',
        'file' => ':attributeフィールドは:minキロバイト以上である必要があります。',
        'numeric' => ':attributeフィールドは:min以上である必要があります。',
        'string' => ':attributeフィールドは:min文字以上である必要があります。',
    ],
    'min_digits' => ':attributeフィールドは:min桁以上の数値である必要があります。',
    'missing' => ':attributeフィールドが存在しない必要があります。',
    'missing_if' => ':otherが:valueの場合、:attributeフィールドが存在しない必要があります。',
    'missing_unless' => ':otherが:valuesにない限り、:attributeフィールドが存在しない必要があります。',
    'missing_with' => ':valuesが存在する場合、:attributeフィールドが存在しない必要があります。',
    'missing_with_all' => ':valuesが全て存在する場合、:attributeフィールドが存在しない必要があります。',
    'multiple_of' => ':attributeフィールドは:valueの倍数である必要があります。',
    'not_in' => '選択された:attributeは無効です。',
    'not_regex' => ':attributeフィールドの形式が無効です。',
    'numeric' => ':attributeフィールドは数値である必要があります。', 
    'password' => [
        'letters' => ':attributeフィールドは少なくとも1文字を含む必要があります。',
        'mixed' => ':attributeフィールドは少なくとも1つの大文字と小文字を含む必要があります。',
        'numbers' => ':attributeフィールドは少なくとも1つの数字を含む必要があります。',
        'symbols' => ':attributeフィールドは少なくとも1つの記号を含む必要があります。',
        'uncompromised' => '指定された:attributeはデータ漏洩に含まれています。別の:attributeを選択してください。',
    ],
    'present' => ':attributeフィールドが存在する必要があります。',
    'present_if' => ':otherが:valueの場合、:attributeフィールドが存在する必要があります。',
    'present_unless' => ':otherが:valuesにない限り、:attributeフィールドが存在する必要があります。',
    'present_with' => ':valuesが存在する場合、:attributeフィールドが存在する必要があります。',
    'present_with_all' => ':valuesが全て存在する場合、:attributeフィールドが存在する必要があります。',
    'prohibited' => ':attributeフィールドは許可されません。',
    'prohibited_if' => ':otherが:valueの場合、:attributeフィールドは許可されません。',
    'prohibited_unless' => ':otherが:valuesにない限り、:attributeフィールドは許可されません。',
    'prohibits' => ':attributeフィールドが存在する場合、:otherは存在できません。',
    'regex' => ':attributeフィールドの形式が無効です。',
    'required' => ':attributeフィールドは必須です。',
    'required_array_keys' => ':attributeフィールドには:valuesへのエントリが必要です。',
    'required_if' => ':otherが:valueの場合、:attributeフィールドは必須です。',
    'required_if_accepted' => ':otherが受け入れられた場合、:attributeフィールドは必須です。',
    'required_if_declined' => ':otherが拒否された場合、:attributeフィールドは必須です。',
    'required_unless' => ':otherが:valuesにない限り、:attributeフィールドは必須です。',
    'required_with' => ':valuesが存在する場合、:attributeフィールドは必須です。',
    'required_with_all' => ':valuesが全て存在する場合、:attributeフィールドは必須です。',
    'required_without' => ':valuesが存在しない場合、:attributeフィールドは必須です。',
    'required_without_all' => ':valuesが全く存在しない場合、:attributeフィールドは必須です。',
    'same' => ':attributeフィールドと:otherは一致する必要があります。',
    'size' => [
        'array' => ':attributeフィールドの項目数は:sizeである必要があります。',
        'file' => ':attributeフィールドは:sizeキロバイトである必要があります。',
        'numeric' => ':attributeフィールドは:sizeである必要があります。',
        'string' => ':attributeフィールドは:size文字である必要があります。',
    ],
    'starts_with' => ':attributeフィールドは次のうちいずれかで始まる必要があります: :values。',
    'string' => ':attributeフィールドは文字列である必要があります。',
    'timezone' => ':attributeフィールドは有効なタイムゾーンである必要があります。',
    'unique' => ':attributeの値は既に使用されています。',
    'uploaded' => ':attributeのアップロードに失敗しました。', 
    'uppercase' => ':attributeフィールドは大文字である必要があります。',
    'url' => ':attributeフィールドは有効なURLである必要があります。',
    'ulid' => ':attributeフィールドは有効なULIDである必要があります。',
    'uuid' => ':attributeフィールドは有効なUUIDである必要があります。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
