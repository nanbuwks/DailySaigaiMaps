<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Daily Saigai Maps</title>
</head>
<body>
<h1>住所から緯度経度を調べます</h1>
<form action=geocode1.php method="GET"> 
<p>
<p>
<input type=text name=address value="<?php echo $_GET["address"]; ?>">住所
<input type=submit>
</form>

<ul>
<li>各種施設などの住所は公式ページなどから取得してください。
<li>熊本県全体などの広域の住所は県庁などの住所を使用してください
</ul>
<a hfef="https://github.com/demouth/DmGeocoder">この変換にはDmGeocoderを使用しています</a>
<p>powered by openforce</p>
<a href="index.php">戻る</a>
<hr>
<?php
ini_set('display_errors', 'ON');
error_reporting(E_ALL);

// UTF-8設定下でのみ動作します
// UTF-8になっていない場合は、このようにUTF-8に変更してください
mb_internal_encoding('UTF-8');

//autoloaderを使わず、Classファイルを手動で読み込む場合は下記ファイルをすべて読み込んでください
$LIB_DIR = realpath(dirname(__FILE__).'/DmGeocoder/src/').'/';
require_once $LIB_DIR.'Dm/Geocoder.php';
require_once $LIB_DIR.'Dm/Geocoder/Address.php';
require_once $LIB_DIR.'Dm/Geocoder/Prefecture.php';
require_once $LIB_DIR.'Dm/Geocoder/Query.php';
require_once $LIB_DIR.'Dm/Geocoder/GISCSV.php';
require_once $LIB_DIR.'Dm/Geocoder/GISCSV/Finder.php';
require_once $LIB_DIR.'Dm/Geocoder/GISCSV/Reader.php';

//ジオコーディング
$result = Dm_Geocoder::geocode($_GET["address"]);
?>
<h2>検索結果:<?php echo count($result); ?>件</h2>
以下に検索結果を表示します。複数候補が有る場合は全て羅列します。
<p>
緯度経度は世界測地系（度分秒標記ではなく度小数点標記）です。
<?php
echo "<pre>";
for ($i = 0; $i< count($result); $i++) {
//  echo var_dump($result[$i]);
  print $result[$i]->prefectureName;
  print $result[$i]->municipalityName;
  print $result[$i]->localName;
  print "\n";
  print $result[$i]->lat;
  print ",";
  print $result[$i]->lng;
  print "\n";
  print "\n";
}
echo "</pre>";
?>
</body>
</html>

