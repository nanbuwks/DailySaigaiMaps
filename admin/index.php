<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Daily Saigai Maps</title>
</head>
<body>
<h1>Daily Saigai Maps  Data Entry</h1>
<form action=input.php method="GET"> 
<p>
<input type=text name=twitterurl>ツィートURL
<p>
<input type=text name=twittercode>「ツィートをサイトへ埋め込む」で取得したHTML
<p>
<input type=text name=latlong>緯度経度 「35.40, 139.50」のように入力してください。（度小数表記）
<p>
<input type=text name=address>住所(必ずしも必要ありませんが、事後に緯度経度を付け直すときに使用します)
<p>
<input type=text name=datadate>どの年月日のページに情報を表示するかを指定してください(2015/04/01のように入力)
<p>
<input type=text name=inputuser>入力者名
<p>
<input type=submit>
</form>
<hr>
住所から緯度経度を調べるには<a href=geocode1.php>こちら</a>
<ul>
<li>
注意：Google サービスを使用して住所または地図から取得した緯度経度を入力に使用できません。
<li>詳細：<a hfef=https://developers.google.com/maps/documentation/geocoding/usage-limits?hl=ja#header_2>「Google Maps Geocoding API は、Google マップと組み合わせてのみ使用することができます。マップに表示せずにジオコーディングの結果を使用することは禁止されています。」</a>
</ul>

<hr>
<p>powered by openforce</p>
</body>
</html>

