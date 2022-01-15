## 概要

このプログラムは、Ｕｄｅｍｙの教材をもとに作成しています。
ＥＣサイトの運営会社を想定しており、Admin(管理者)・Member(スタッフ)・User(お客様)と
３つのログイン情報で管理しています。

- Admin

 - スタッフ情報の登録・編集・削除

 - カテゴリーの登録・編集・削除

 - 店舗情報の編集(情報編集・休日設定(簡易版))

 - 販売情報の閲覧

 - 商品情報の閲覧

- Member

 - 勤怠管理(簡易版)

 - 商品画像の登録・編集・削除

 - 商品の登録・編集・削除

 - 販売管理(自分の担当する商品が購入された後の処理(簡易版))

- User

 - 商品の購入

 - 店舗情報の閲覧

 - 購入履歴の閲覧

## ダウンロード方法
git clone

git clone https://github.com/mkj4911/mkj-test.git

もしくはzipファイルでダウンロードしてください

インストール方法
- cd mkj-test
- composer install
- npm install
- npm run dev
.env.example をコピーして .env ファイルを作成

.envファイルの中の下記をご利用の環境に合わせて変更してください。

- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=9090
- DB_DATABASE=mkj-test
- DB_USERNAME=mkj
- DB_PASSWORD=password123

XAMPP/MAMPまたは他の開発環境でDBを起動した後に

php artisan migrate:fresh --seed

と実行してください。(データベーステーブルとダミーデータが追加されればOK)

最後に php artisan key:generate と入力してキーを生成後、

php artisan serve で簡易サーバーを立ち上げ、表示確認してください。

インストール後の実施事項
画像のダミーデータは public/imagesフォルダ内に sample(1).jpg 〜 sample(57).jpg として 保存しています。

php artisan storage:link で storageフォルダにリンク後、

storage/app/public/productsフォルダ内に 保存すると表示されます。 (productsフォルダがない場合は作成してください。)
上手く表示されない場合は、public/storageフォルダを一旦削除し、再度　php artisan storage:linkを実行してください。

ショップの画像も表示する場合は、 storage/app/public/shopsフォルダを作成し 画像を保存してください。

## 機能

-決済のテストとしてstripeを利用しています。 必要な場合は .env にstripeの情報を追記してください。


-メールのテストとしてmailtrapを利用しています。 必要な場合は .env にmailtrapの情報を追記してください。

メール処理には時間がかかるので、 キューを使用しています。

必要な場合は php artisan queue:workで ワーカーを立ち上げて動作確認するようにしてください。