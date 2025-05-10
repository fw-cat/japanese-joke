# Vue.js コーディング規約

## 命名規則

### コンポーネント
- コンポーネント名はPascalCase
- コンポーネントファイルは`.vue`拡張子
- コンポーネントディレクトリはPascalCase
- ベースコンポーネントは`Base`プレフィックス
- 単一インスタンスコンポーネントは`The`プレフィックス

### プロパティ・メソッド
- プロパティ名はcamelCase
- メソッド名はcamelCase
- イベント名はkebab-case
- コンポーネントのpropsは詳細な型定義

### ファイル名
- コンポーネント: `{コンポーネント名}.vue`
- コンポーネントディレクトリ: `{コンポーネント名}/`
- ミックスイン: `{機能名}Mixin.js`
- プラグイン: `{機能名}Plugin.js`

## コーディングスタイル

### 基本ルール
- インデントは2スペース
- セミコロンは必須
- シングルクォートを使用
- コンポーネントの属性は複数行で記述
- プロパティの型定義は必須

### 命名規則の例
```vue
<!-- BaseButton.vue -->
<template>
  <button
    :class="[
      'base-button',
      `base-button--${type}`,
      { 'base-button--disabled': disabled }
    ]"
    :disabled="disabled"
    @click="handleClick"
  >
    <slot></slot>
  </button>
</template>

<script>
export default {
  name: 'BaseButton',
  props: {
    type: {
      type: String,
      default: 'primary',
      validator: (value) => ['primary', 'secondary', 'danger'].includes(value)
    },
    disabled: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    handleClick(event) {
      this.$emit('click', event)
    }
  }
}
</script>
```

## ディレクトリ構造

### アプリケーション構造
- コンポーネント: `resources/js/components`
  - 共通: `resources/js/components/common`
  - レイアウト: `resources/js/components/layout`
  - 機能別: `resources/js/components/{機能名}`
- ページ: `resources/js/pages`
- ストア: `resources/js/store`
  - モジュール: `resources/js/store/modules`
- ルーター: `resources/js/router`
- ユーティリティ: `resources/js/utils`
- プラグイン: `resources/js/plugins`
- ミックスイン: `resources/js/mixins`
- 型定義: `resources/js/types`

### コンポーネント構造
```
components/
├── common/
│   ├── BaseButton.vue
│   └── BaseInput.vue
├── layout/
│   ├── TheHeader.vue
│   └── TheFooter.vue
└── user/
    ├── UserProfile.vue
    └── UserSettings.vue
```

## ベストプラクティス

### コンポーネント設計
- 単一責任の原則に従う
- 再利用可能なコンポーネントを作成
- プロップスとイベントで親子間の通信
- スロットを使用した柔軟なコンテンツ挿入

### 状態管理
- Vuexストアの適切な分割
- モジュール化されたストア設計
- アクションとミューテーションの明確な分離
- ゲッターの適切な使用

### パフォーマンス
- コンポーネントの遅延ロード
- 適切なキーの使用
- 不要な再レンダリングの防止
- メモ化の適切な使用

### テスト
- コンポーネントの単体テスト
- ストアのテスト
- イベントのテスト
- スナップショットテスト 