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
echo "<pre>";
var_dump($result);
echo "</pre>";
