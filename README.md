# Laravel + Vue.jsで構築するWebサイト勉強用プロジェクト

## インストールコマンド (事前にcomposerとnodeをインストールしておく)
1. composer create-project --prefer-dist laravel/laravel ./  
   Larabelプロジェクトの生成
1. composer require laravel/ui  
   追加ライブラリのインストール
1. php artisan ui vue --auth  
   ログイン機能作成
1. npm install
   Vueなどの必要パッケージをインストール  
   ※インストールされるパッケージはpackage.jsonに記載されている
1. 「composer create-project」で生成したフォルダ内の「.env」から以下の項目を自分の環境に合わせて編集
   DB_HOST=mysql  
   DB_DATABASE=default  
   DB_USERNAME=default  
   DB_PASSWORD=secret
1. php artsisan migrate  
   /database/migrations/*.phpに記載された内容でDBにテーブルを生成  
   ※Laravel標準のログイン機能を編集したりするなら上記のphpを編集してからにする。  
   ※※「/database/migrations/*.php」を修正する場合、対応する「/app/Models/*.php」も忘れずに修正する。

## フロントエンド (Vue.js) 
### 画面の追加や修正をするなら以下のファイルを編集
 * /resources/js/components/*.vue  
   Vue.jsの部品となるファイルを格納する
 * /resources/js/app.js  
   格納した.vueファイルをコンポーネントとして登録する
 * /resources/views/*.blade.php
   画面のベースとなるphpファイルを格納
 * /routes/web.php  
   ルーティングの設定を記述する

## Back End (Laravel)
### Larabel標準の認証機能をカスタマイズする場合に編集する場所  
    デフォルトのemailだけではなく自前で追加したlogin_idでもログイン可能とする場合
 * /app/Http/Controllers/*Controller  
   デフォルトで作成されるHomeControllerを修正するのがいいかも
 * /app/Providers/UserProvider/*Provider.php  
   認証情報などから該当するユーザーを探したりするクラス
 * /app/Providers/AppServiceProvider.php  
   自前のプロバイダーをLaravelに登録する
 * /app/Providers/RouteServiceProvider.php
   ログイン後に遷移するページの設定ができる
 * /config/auth.php  
   使用するプロバイダーを設定できる
 * /vendor/laravel/ui/auth-backend/* AuthenticatesUsers.php  
   デフォルトのemail以外で認証するならこのクラスのusernameメソッドを修正する。
 * /resources/views/*.blade.php  
   ログイン後に表示する画面などのテンプレート
 * /resources/views/auth/*.blade.php  
   ログイン画面やユーザー登録画面のテンプレート
 * /resources/views/auth/layouts/*.blade.php  
   各個別画面のテンプレート
 * /routes/web.php  
   ルーティングの設定を記述する。
   ルーティングに認証が必要かどうかも合わせて記述できる。

