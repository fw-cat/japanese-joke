# PHP/Laravel コーディング規約

## 基本方針

### コーディングスタイル
- PSR-12に準拠
- インデントは4スペース
- 行の最大長は120文字
- メソッドの引数は1行に1つ
- 配列の最後の要素にもカンマを付ける
- 型宣言は必須
- 戻り値の型宣言は必須
- プロパティの型宣言は必須

### 命名規則

#### クラス・インターフェース・トレイト
- クラス名はPascalCase
- インターフェース名は`Interface`サフィックス
- トレイト名は`Trait`サフィックス
- 抽象クラス名は`Abstract`プレフィックス
- 例外クラス名は`Exception`サフィックス

#### メソッド・変数
- メソッド名はcamelCase
- 変数名はcamelCase
- 定数はUPPER_SNAKE_CASE
- プライベートメソッドは`_`プレフィックス
- ブール値を返すメソッドは`is`、`has`、`can`で始める

#### ファイル名
- クラスファイルは`{クラス名}.php`
- インターフェースファイルは`{インターフェース名}.php`
- トレイトファイルは`{トレイト名}.php`
- テストファイルは`{クラス名}Test.php`

## アプリケーション構造

### ディレクトリ構成
```
app/
├── Console/
│   └── Commands/
├── Http/
│   ├── Controllers/
│   ├── Middleware/
│   └── Requests/
├── Models/
├── Services/
├── Repositories/
├── Events/
├── Listeners/
├── Jobs/
├── Mail/
├── Notifications/
├── Policies/
└── Providers/
```

### 各ディレクトリの役割

#### Controllers
- シングルアクションコントローラーを推奨
- ビジネスロジックはサービスに移動
- バリデーションはFormRequestを使用
- レスポンスはResourceを使用

#### Models
- スコープは`scope`プレフィックス
- アクセサは`get{Attribute}Attribute`
- ミューテータは`set{Attribute}Attribute`
- リレーションは明確な命名
- カスタムクエリビルダは`{モデル名}QueryBuilder`

#### Services
- インターフェースを実装
- 依存性注入を使用
- トランザクション処理を適切に実装
- ビジネスロジックの集約

#### Repositories
- インターフェースを実装
- クエリビルダの抽象化
- キャッシュ戦略の実装
- データアクセス層の分離

## コーディング例

### コントローラー
```php
<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    ) {
    }

    public function store(StoreRequest $request): UserResource
    {
        $user = $this->userService->create($request->validated());

        return new UserResource($user);
    }
}
```

### モデル
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
```

### サービス
```php
<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserService implements UserServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {
    }

    public function create(array $data): User
    {
        return DB::transaction(function () use ($data) {
            $user = $this->userRepository->create($data);
            
            // 追加の処理
            
            return $user;
        });
    }
}
```

## テスト

### テスト構造
```
tests/
├── Unit/
│   ├── Services/
│   └── Repositories/
├── Feature/
│   └── Http/
└── Browser/
```

### テスト命名規則
- テストクラス名は`{テスト対象クラス名}Test`
- テストメソッド名は`test_{テスト内容}`
- データプロバイダは`{テストメソッド名}DataProvider`

### テスト例
```php
<?php

namespace Tests\Unit\Services;

use App\Services\UserService;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    public function test_create_user(): void
    {
        // テストコード
    }

    /**
     * @dataProvider createUserDataProvider
     */
    public function test_create_user_with_invalid_data(array $data): void
    {
        // テストコード
    }

    public function createUserDataProvider(): array
    {
        return [
            'empty_name' => [
                'data' => [
                    'name' => '',
                    'email' => 'test@example.com',
                ],
            ],
        ];
    }
}
```

## セキュリティ

### 入力値の検証
- FormRequestを使用
- バリデーションルールは明確に定義
- カスタムバリデーションルールは必要に応じて作成

### 認証・認可
- ミドルウェアで適切に制御
- ポリシーを使用した認可
- ゲートを使用した認可

### データ保護
- 機密情報は適切に暗号化
- パスワードはハッシュ化
- セッション管理の適切な実装 