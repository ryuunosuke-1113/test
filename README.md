<<<<<<< HEAD
# test
=======
# スケジュール管理アプリ（Laravel）

## 概要
Laravel（Blade）を用いて、ユーザー認証付きのスケジュール管理アプリを個人開発しました。  
ログインユーザーごとに予定データを分離し、業務アプリを想定した最小構成（MVP）を意識して実装しています。

## 主な機能
- ユーザー登録 / ログイン / ログアウト（Laravel Breeze）
- ログインユーザーごとの予定管理
- 当日の予定のみ表示
- 予定の検索（タイトル・メモ）
- 表示切り替え（今日の予定 / すべての予定）
- 予定の作成 / 編集 / 削除

## 使用技術
- PHP
- Laravel
- Blade
- Laravel Breeze（認証）
- SQLite
- Eloquent ORM

## 画面構成
- ログイン画面
- 予定一覧画面
- 予定作成画面
- 予定編集画面

## 設計・実装上の工夫
- 予定データは必ずログインユーザー経由で取得・保存する設計にし、
  user_id をリクエストから受け取らないようにしています。
- 他ユーザーの予定を操作できないように制御しています。
- 当日予定の抽出や検索機能など、実務で必要となる基本機能を優先して実装しました。
- SQLite の制約を考慮し、マイグレーションの設計を見直しながら実装しました。

## 学んだこと
- Laravelにおける認証の仕組みと、ユーザーごとのデータ分離の考え方
- マイグレーション設計とDB制約によるエラー対応
- 業務アプリを想定したController・Model設計

## セットアップ方法
```bash
git clone <リポジトリURL>
cd schedule-app
composer install
php artisan migrate
php artisan serve
>>>>>>> 807c96e (Add schedule app with authentication and user-based data separation)
