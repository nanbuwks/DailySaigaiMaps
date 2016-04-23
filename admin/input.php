<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Data ently</title>
</head>
<body>
<a href="index.php">return</a>
<?php

$latlong=$a_3= explode(",",$_GET[latlong]);
$latitude=$latlong[0];
$longtude=$latlong[1];
$twitterpath = parse_url($_GET["twitterurl"])["path"];
$twitterid =  substr($twitterpath,strrpos( $twitterpath , '/' )+1 );
echo $twitterid;

include 'dbconnect.php';

 $result = mysql_query('select twittercode from incident where twitterid='.$twitterid.';');
 if ( 0 != mysql_num_rows($result) ) {
   echo  "<hr><h1>既に登録されています</h1>";
   $row = mysql_fetch_assoc($result);
   echo ($row['twittercode']);
} else {

$querystring ='insert INTO incident (twitterid,twitterurl,twittercode,latitude,longtude,address,datadate,inputuser)
 VALUES (
"'.$twitterid.'",
"'.$_GET["twitterurl"].'",
"'.addslashes($_GET["twittercode"]).'",
"'.$latitude.'",
"'.$longtude.'",
"'.$_GET["address"].'",
"'.$_GET["datadate"].'",
"'.$_GET["inputuser"].'"
);';
$result = mysql_query($querystring);
if (!$result) {
//    echo $querystring;
    die('database error:'.mysql_error());
} else {
// echo $_GET["twittercode"];
 $result = mysql_query('select twittercode from incident where twitterid='.$_GET["twitterid"].';');
 $row = mysql_fetch_assoc($result);
 echo ($row['twittercode']);
 echo  "<hr><h1>Data Entryed!</h1>";

 }
}

?>
</body>
</html>

