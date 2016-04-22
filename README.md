# DailySaigaiMaps

## 必要環境

+ 一般的なLAMP環境です。
++ Linux
++ Apache(PHPが動く環境ならOKです)
++ MySQL(ないし互換)
++ PHP

## MySQLの操作

+ あらかじめ、以下の準備が必要です。
+ DailySaigaiMapsデータベースを作成
+テーブル作成
+ mktable.sqlファイルがadminディレクトリ内に存在しますので、
+ mysql -u root dailysaigaimaps < mktable.sql
+ のようにしてテーブルを作成してください。
+ 必要に応じてユーザー設定設定をしてください。

## INSTALL

+ dbconnect.php.template
+ を適当なエディターで開き、
+ 接続先ホスト（同じマシンでMySQLが動いている場合はlocalhost）
+ ユーザー名（簡単にするならroot、セキュリティ的にもう少し考えるなら別ユーザー）
+ パスワード
+ を修正してください。
+ dbconnect.php.template -> dbconnect.php に名前を変更してください。
