<?php
error_reporting(0);
include("conn.php");
ob_start();
function reel_ip() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //Proxy den bağlanıyorsa gerçek IP yi alır.

    {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
   elseif (!empty($_SERVER['HTTP_X_FORWARDED'])) //Proxy den bağlanıyorsa gerçek IP yi alır.

    {
        $ip = $_SERVER['HTTP_X_FORWARDED'];
    }

   elseif (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) //Proxy den bağlanıyorsa gerçek IP yi alır.

    {
        $ip = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    }
	   elseif (!empty($_SERVER['HTTP_FORWARDED'])) //Proxy den bağlanıyorsa gerçek IP yi alır.

    {
        $ip = $_SERVER['HTTP_FORWARDED'];
    }
    else
    {
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function ErrorMessage($type, $method) {
die('<!--
Author : Ali Can Gönüllü
2020-2021
Respect !
-->
<head><meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" media="screen" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600" />
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
<link rel="stylesheet" media="screen" href="style.css" /></head>
  <body class="background error-page-wrapper background-color background-image">
    <center>
  <div class="content-container shadow">
  <br>
    <div class="head-line secondary-text-color">
		Illegal Girişim Algılandı
    </div>
	<div class="hr"></div>
    <div class="context primary-text-color">
      Deneme Türü : '.strip_tags($type).' ('.strip_tags($method).')
    </div>
    <div class="hr"></div>
    <div class="context secondary-text-color">
	<p> Method Türü : '.strip_tags($method).'</p>
      <p>URL : <br>'.strip_tags($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']).'</p>
	  <p>User-Agent : <br>'.strip_tags($_SERVER['HTTP_USER_AGENT']).'</p>
	  <p>IP : <br>'.strip_tags(reel_ip()).'</p>
	  <p>Tarih : '.date('d.m.Y H:i:s').'</p>
    </div><br>
    <div class="buttons-container">
      <a class="button" onclick="history.back();" target="_blank"><span class="fa fa-home"></span> Geri Dön</a>
      <a class="button" href="mailto:alicangonullu@yahoo.com" target="_blank"><span class="fa fa-warning"></span> Problem Bildir</a>
    </div></body>');
}
function IPError($ad) {
if(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2) == "tr") {
echo '<br><div class="context secondary-text-color">
<p>IP Adresiniz '.strip_tags($ad).' Saat Banlandı.</p>
</div>';
} else {
echo '<br><div class="context secondary-text-color">
<p>IP Adress : '.strip_tags($ad).' Banned from Web Server for One Hour.</p>
</div>';
}
}

function LogIslem($ad) {
foreach ($ad as $key => $value) {
$json = "".strip_tags($key)."¿".strip_tags($value)."";
$yasakla = explode('¿',$json);
$json2 = var_dump(json_encode($yasakla));
	}
}

function HeaderIslem() {
$header = apache_request_headers();
foreach ($header as $headers => $value) {
$jsons = ''.strip_tags($headers).'¿?'.strip_tags($value).'';
$yasakla = explode('¿?',$jsons);
$jsonk = var_dump(json_encode($yasakla));
	}
}

function Debug() {
echo '<pre class="container">';
if($_SERVER['REQUEST_METHOD'] == "GET") {
$getlog = LogIslem($_GET);
echo '<br>';
$gethead = HeaderIslem();
} elseif($_SERVER['REQUEST_METHOD'] == "POST")
{
$getpost = LogIslem($_POST);
echo '<br>';
$gethead = HeaderIslem();
} else {
$getpost = LogIslem($_SERVER['REQUEST_METHOD']);
echo '<br>';
$gethead = HeaderIslem();
}
echo '</pre>';
}

function memlimit($limit, $type) {
	ini_set('memory_limit',''.$limit.''.$type.'');
}

function kisalt($metin, $uzunluk){
$metin = substr($metin, 0, $uzunluk)."...";
$metin_son = strrchr($metin, " ");
$metin = str_replace($metin_son," ...", $metin);
return $metin;
}
?>