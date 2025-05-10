# データベース コーディング規約

## 命名規則

### テーブル
- テーブル名は複数形のスネークケース
- 中間テーブルは`{テーブル1}_{テーブル2}`の形式
- テーブル名は小文字のみ使用

### カラム
- カラム名はスネークケース
- 外部キーは`{テーブル名}_id`の形式
- タイムスタンプは`created_at`と`updated_at`
- 論理削除は`deleted_at`
- フラグは`is_{状態}`の形式

### インデックス
- インデックス名は`idx_{テーブル名}_{カラム名}`の形式
- ユニークインデックス名は`unq_{テーブル名}_{カラム名}`の形式
- 外部キーインデックス名は`fk_{テーブル名}_{参照テーブル名}`の形式

## テーブル設計

### 基本ルール
- 主キーは`id`（bigint, unsigned, auto_increment）
- タイムスタンプは`created_at`と`updated_at`
- 論理削除は`deleted_at`
- 外部キーにはインデックスを設定
- カラムのNULL許容は最小限に

### データ型
- 整数: `INT`（通常）, `BIGINT`（ID）
- 文字列: `VARCHAR(255)`（通常）, `TEXT`（長文）
- 日時: `DATETIME`（タイムゾーン考慮）, `TIMESTAMP`（自動更新）
- 真偽値: `TINYINT(1)`（0/1）
- 金額: `DECIMAL(10,2)`（小数点2桁）

### 命名規則の例
```sql
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    deleted_at DATETIME NULL,
    UNIQUE KEY unq_users_email (email),
    KEY idx_users_name (name)
);

CREATE TABLE user_profiles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    phone_number VARCHAR(20) NULL,
    address TEXT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    FOREIGN KEY fk_user_profiles_users (user_id) REFERENCES users(id)
);
```

## マイグレーション

### 命名規則
- マイグレーション名は`{YYYY_MM_DD_HHMMSS}_{操作}_{テーブル名}`の形式
- 操作は`create_`, `add_`, `modify_`, `drop_`など

### ベストプラクティス
- ロールバック可能な設計
- 外部キー制約は別のマイグレーションで設定
- インデックスは別のマイグレーションで設定
- データの変更は別のマイグレーションで実行

### マイグレーションの例
```php
// テーブル作成
public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password');
        $table->boolean('is_active')->default(true);
        $table->timestamps();
        $table->softDeletes();
    });
}

// インデックス追加
public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->index('name', 'idx_users_name');
    });
}
```

## クエリ最適化

### インデックス設計
- 検索条件に使用するカラムにインデックス
- 外部キーにインデックス
- 複合インデックスの順序に注意
- 不要なインデックスは削除

### クエリパフォーマンス
- N+1問題の回避
- 適切なJOINの使用
- サブクエリの最適化
- インデックスを活用した検索

### トランザクション
- 適切なトランザクション境界
- デッドロックの回避
- ロックの粒度の最適化
- トランザクションの分離レベル 