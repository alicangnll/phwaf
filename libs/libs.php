<?php
include("conn.php");
header("X-Frame-Options: SAMEORIGIN");
function style() {
?>
<style>
@import 'https://fonts.googleapis.com/css?family=Inconsolata';

html {
  min-height: 100%;
}

body {
  box-sizing: border-box;
  height: 100%;
  background-color: #000000;
  background-image: radial-gradient(#11581E, #041607), url("https://media.giphy.com/media/oEI9uBYSzLpBK/giphy.gif");
  background-repeat: no-repeat;
  background-size: cover;
  font-family: 'Inconsolata', Helvetica, sans-serif;
  font-size: 1.5rem;
  color: rgba(128, 255, 128, 0.8);
  text-shadow:
      0 0 1ex rgba(51, 255, 51, 1),
      0 0 2px rgba(255, 255, 255, 0.8);
}

.noise {
  pointer-events: none;
  position: absolute;
  width: 100%;
  height: 100%;
  background-image: url("https://media.giphy.com/media/oEI9uBYSzLpBK/giphy.gif");
  background-repeat: no-repeat;
  background-size: cover;
  z-index: -1;
  opacity: .02;
}

.overlay {
  pointer-events: none;
  position: absolute;
  width: 100%;
  height: 100%;
  background:
      repeating-linear-gradient(
      180deg,
      rgba(0, 0, 0, 0) 0,
      rgba(0, 0, 0, 0.3) 50%,
      rgba(0, 0, 0, 0) 100%);
  background-size: auto 4px;
  z-index: 1;
}

.overlay::before {
  content: "";
  pointer-events: none;
  position: absolute;
  display: block;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  height: 100%;
  background-image: linear-gradient(
      0deg,
      transparent 0%,
      rgba(32, 128, 32, 0.2) 2%,
      rgba(32, 128, 32, 0.8) 3%,
      rgba(32, 128, 32, 0.2) 3%,
      transparent 100%);
  background-repeat: no-repeat;
  animation: scan 7.5s linear 0s infinite;
}

@keyframes scan {
  0%        { background-position: 0 -100vh; }
  35%, 100% { background-position: 0 100vh; }
}

.terminal {
  box-sizing: inherit;
  position: absolute;
  height: 100%;
  width: 1000px;
  max-width: 100%;
  padding: 4rem;
  text-transform: uppercase;
}

.output {
  color: rgba(128, 255, 128, 0.8);
  text-shadow:
      0 0 1px rgba(51, 255, 51, 0.4),
      0 0 2px rgba(255, 255, 255, 0.8);
}

.output::before {
  content: "> ";
}

/*
.input {
  color: rgba(192, 255, 192, 0.8);
  text-shadow:
      0 0 1px rgba(51, 255, 51, 0.4),
      0 0 2px rgba(255, 255, 255, 0.8);
}

.input::before {
  content: "$ ";
}
*/

a {
  color: #fff;
  text-decoration: none;
}

a::before {
  content: "[";
}

a::after {
  content: "]";
}

.errorcode {
  color: white;
}
</style>
<?php
}
function IPError($ad) {
if(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2) == "tr") {
echo '<div class="context secondary-text-color">
<p>IP Adresiniz '.strip_tags($ad).' Saat Banlandı.</p>
</div>';
} else {
echo '<div class="context secondary-text-color">
<p>IP Adress : '.strip_tags($ad).' Banned from Web Server for One Hour.</p>
</div>';
}
}

function reel_ip()
{
if (!empty($_SERVER['HTTP_CLIENT_IP']))
{$ip=$_SERVER['HTTP_CLIENT_IP'];}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //Proxy den bağlanıyorsa gerçek IP yi alır.
{$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];}
elseif (!empty($_SERVER['HTTP_X_FORWARDED'])) //Proxy den bağlanıyorsa gerçek IP yi alır.
{$ip = $_SERVER['HTTP_X_FORWARDED'];}
elseif (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) //Proxy den bağlanıyorsa gerçek IP yi alır.
{$ip = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];}
elseif (!empty($_SERVER['HTTP_FORWARDED'])) //Proxy den bağlanıyorsa gerçek IP yi alır.
{$ip = $_SERVER['HTTP_FORWARDED'];}
else
{$ip=$_SERVER['REMOTE_ADDR'];}
return $ip;
}

function DoSDenetleme($count) {
 $data = strlen($_SERVER['QUERY_STRING']);
  if($data < $count) {
    header('X-AliWAF-DoS: ACTIVE');
    echo $data;
  } else {
    header('X-AliWAF-DoS: DETECT');
    die("DoS Detected | Please Control URL");
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

function Error($ip, $url, $usragent, $tarih, $tur) {
if(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2) == "tr") {
echo '<div class="noise"></div>
<div class="overlay"></div>
<div class="terminal">
  <h1>Illegal Kod Algılandı <span class="errorcode">('.strip_tags($tur).')</span></h1>
  <p class="output">IP Adresiniz : <span class="errorcode">'.strip_tags($ip).'</span></p>
  <p class="output">User Agent : <span class="errorcode">'.strip_tags($usragent).'</span></p>
  <p class="output">Tarih : <span class="errorcode">'.strip_tags($tarih).'</span></p>
    <div class="buttons-container">
      <a class="button" onclick="history.back();" target="_blank"><span class="fa fa-home"></span>Geri Dön</a>
      <a class="button" href="mailto:alicangonullu@yahoo.com" target="_blank"><span class="fa fa-warning"></span>Problem Bildir</a>
      <a class="button" href="https://github.com/alicangonullu/" target="_blank"><span class="fa fa-github"></span>GitHub</a>
    </div>
</div>';
 die();
} else {
 echo '<div class="noise"></div>
<div class="overlay"></div>
<div class="terminal">
  <h1>Illegal Code Detected <span class="errorcode">('.$tur.')</span></h1>
  <p class="output">IP Adress : <span class="errorcode">'.strip_tags($ip).'</span></p>
  <p class="output">User Agent : <span class="errorcode">'.strip_tags($usragent).'</span></p>
  <p class="output">Date  : <span class="errorcode">'.strip_tags($tarih).'</span></p>
    <div class="buttons-container">
      <a class="button" onclick="history.back();" target="_blank"><span class="fa fa-home"></span>Back</a>
      <a class="button" href="mailto:alicangonullu@yahoo.com" target="_blank"><span class="fa fa-warning"></span>Notify Problem</a>
      <a class="button" href="https://github.com/alicangonullu/" target="_blank"><span class="fa fa-github"></span>GitHub</a>
    </div>
</div>';
 die();
}

}
function Debug() {
echo '<body><pre>';
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
echo '</pre></body>';
}

function memlimit($limit, $type) {
	ini_set('memory_limit',''.$limit.''.$type.'');
}
?>
