<!DOCTYPE html>
<html style='height:100%; width:100%'>
<head>
<meta charset="UTF-8">
<?php

 date_default_timezone_set('Asia/Tokyo');
 if ( FALSE == isset( $_GET["year"], $_GET["month"], $_GET["day"]) ){
  $year=date("Y");
  $month=date("m");
  $day=date("d");

  } else {
    $year = (int)$_GET["year"];
    $month = (int)$_GET["month"];
    $day = (int)$_GET["day"];

  }
 $targetdate= $year.'-'.$month.'-'.$day;

 include("admin/dbconnect.php")

?>

<title>Data ently</title>

<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.css" />
<script src="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.js"></script>
<script type='text/javascript'>

//leaflet OSM map
function init() {

  // create a map in the "map_elemnt" div,
  // set the view to a given place and zoom
  var map = L.map('map_elemnt');
  map.setView([32.70, 130.70], 9);

  // add an OpenStreetMap tile layer
  var tileLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
	attribution : '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
  });
  tileLayer.addTo(map);

  // add layers
  var baseLayers = { "OpenStreetMap": tileLayer };

  // add control scale 
  L.control.scale().addTo(map);



// add a marker in the given location,
// attach some popup content to it and open the popup
var markerArray=[];
<?php

// $result = mysql_query('select twittercode from incident where twitterid='.$_GET["twitterid"].';');
 $result = mysql_query('select latitude,longtude,twittercode from incident where  DATE( `datadate` ) = "'.$targetdate.'";');
  while ($row = mysql_fetch_assoc($result)) {
?>
var mapMarker = L.marker([<?php  echo $row["latitude"];echo ",";echo $row["longtude"];?>]);
mapMarker.addTo(map);
mapMarker.bindPopup('<?php 
  echo strip_tags($row["twittercode"]);
 ?>
 ');
mapMarker.openPopup();

<?php  } ?>

markerArray.push(mapMarker);
markers.addLayers(markerArray);


//  var overlays = { "Marker": mapMarker, };
  L.control.layers(baseLayers, overlays).addTo(map);				

  }
</script>
</head>
<body onload='init();' style='height:100%; width:100%'>

<H1>DSM</H1>
Daily Saigai Maps<p>


<div id='map_elemnt' style='width: 100%; height: 80%; border: solid 1px #999;'></div>

<form action="index.php">
<select name="year">
<option>2016</option>
</select>
<select name="month">
<?php for ($i=1;$i<13;$i++) { ?>
  <option<?php if ($month == $i) echo " selected";?>>
  <?php echo $i;?></option>
<?php } ?>
</select>
<select name="day">
<?php for ($i=1;$i<32;$i++) { ?>
  <option<?php if ($day == $i ) echo " selected";?>>
  <?php echo $i;?></option>
<?php } ?>
</select>
<input type=submit>
</form>
<h2><?php echo $targetdate; ?>前後10日のデータ</h2>
<?php
$result = mysql_query('select date(datadate) as date, date_format(datadate, "%Y") as year, date_format(datadate, "%m") as month, date_format(datadate, "%d") as day, count(datadate) as cnt from incident where  date(datadate) >= "'.$targetdate.'" - interval 10 day and date(datadate) <= "'.$targetdate.'" + interval 10 day group by datadate order by datadate; ');
  while ($row = mysql_fetch_assoc($result)) {
   echo "<a href=index.php?year=".$row["year"]."&month=".$row["month"]."&day=".$row["day"].">";

    echo $row["date"];
    echo " : ";
    echo $row["cnt"];
    echo "件";
  echo "</a>";
    echo "<p>";
  }
?>
<hr>
<h2>DSMとは</h2>
<ul>
<li>災害時にTwitterで流れる野良情報をマッピングしています。
<li>OSSで使用、LAMP環境でどこでも簡単に同じようなサービスを立ち上げることができます。
<li>独自に作成した部分はPublic DomainとしてGitHubに公開しています（改変・自分のサーバで使用・改変など誰でも自由にお使いください）。
<li><a href="https://github.com/nanbuwks/DailySaigaiMaps">https://github.com/nanbuwks/DailySaigaiMaps</a>
<li>確度の高い情報マップは他に沢山存在します。そちらの補助としてお使いください。
</ul>
<h2>ご注意</h2>
<ul>
<li>ツィートからのマッピングはキーワードより住所を割り出し、緯度経度に変換しています。
<li>緯度経度変換（ジオコーディング）は国土交通省の大字・町丁目レベル位置参照情報を基にしています。
<li>丁目までの情報しか無いため100m単位ぐらいまでの正確さとなります。
<li>マップ情報はOpenStreetMapを使用しています。
<li>まだ地図に書き込まれている情報が少ない地域もあります。他の地図サービスのように建物１つ１つを特定できる程ではありませんことをご了承ください。
</ul>
<h2>使い方</h2>
<ul>
<li>熊本県全体などの広域の住所は県庁などの住所を使用しています
<li>情報の真偽は判定していません。twitterの元ツィートなどをご参照ください。
<li>旬が過ぎた情報も添削せず、そのまま放置して過去日となるだけです。
<li>確度の高い情報マップは他に沢山存在します。そちらの補助としてお使いください。
</ul>
<h2>tweet情報の利用について</h2>
<ul>
<li>利用させていただいた個別のツィートにおきまして、利用許可依頼のご連絡は致しておりません。
<li>利用させて頂いているツィートはTwitter社のライセンスに基づいて利用しています。
<li>非公開アカウントではないツィートを適切な方法で取得したものはパブリックな情報となります。
<li>利用している情報は公正な扱いを心がけておりますが、労力の不足などにより偏り、不適切なツィートを選別することなども発生します。
<li>また、サービスやプログラムもよきものを提供できるよう努力しておりますが、力及ばずのところも多々有るのが実情です。
<li>何卒サービスの実施にご理解ください。
</ul>
<h2>データ入力</h2>
現在のところ、人手で入力をしています。
入力に興味の有る方はオープンフォースMLにご参加ください
（参加方法はオープンフォース公式ページをご参照ください）
<p>
<a href="admin/input.php">データ入力はこちら</a>
<h2>誰がやっているの？</h2>
<a href=http://openforce.project2108.com>秘密結社オープンフォース</a>

</body>
</html>

