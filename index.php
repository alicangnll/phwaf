<?php
error_reporting(0);
include("conn.php");
session_start();
$_SESSION["csrf"] = sha1(md5(rand()));
$update = "http://alicangnll.github.io/phpwaf-phanalyzer/";
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="pH Analyzer">   
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="css/metro-all.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script src="js/metro.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<style>
* {box-sizing: border-box;}

.header {
  overflow: hidden;
  background-color: #f1f1f1;
  padding: 20px 10px;
}

.header a {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}

.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

.header a:hover {
  background-color: #ddd;
  color: black;
}

.header a.active {
  background-color: dodgerblue;
  color: white;
}

.header-right {
  float: right;
}

@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  
  .header-right {
    float: none;
  }
}
body{
  margin: 0;
  font-family:Verdana,sans-serif;
  font-size:15px;
  line-height:1.5;
  font-family: Arial, Helvetica, sans-serif;
  color:black;
}
.simple-login-container{
    width:300px;
    max-width:100%;
    margin:50px auto;
}
.simple-login-container h2{
    text-align:center;
    font-size:20px;
}

.simple-login-container .btn-login{
    background-color:#FF5964;
    color:#fff;
}
a{
    color:black;
}

@media (max-width:800px) {
body {
margin: 0;
font-size:14px;
color:black;
background-repeat: no-repeat;
}
.manzara {
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0, 0.4); /* Black w/opacity/see-through */
  color: white;
  font-weight: bold;
  text-align: center;
  padding: 15px;
}
.form-control {
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0, 0.4); /* Black w/opacity/see-through */
  color: white;
  box-shadow: 3px solid #f1f1f1;
  z-index: 2;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 100%;
}
}
@media (min-width:800px) {
body {
background-repeat: no-repeat;
}
.manzara {
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0, 0.4); /* Black w/opacity/see-through */
  color: white;
  box-shadow: 3px solid #f1f1f1;
  z-index: 2;
  position: absolute;
  text-align: center;
  top: 50%;
  font-weight: bold;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 100%;
}
.form-control {
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0, 0.4); /* Black w/opacity/see-through */
  color: white;
  box-shadow: 3px solid #f1f1f1;
  z-index: 2;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 100%;
}

.container  {
border-radius: 20px;
}

}
</style>
	<title>pH Analyzer | AliWAF</title>  
</head>
<?php
if(file_exists("yukle.lock")) {
} else {
die("<center><b>PHP WAF Yüklenemedi / PHP WAF was not Installed</b>
<hr></hr>
<p>yukle.lock oluşturulmamış</b><br>
<a href='install.php'>Yükle</a></center>");
}
function LoginCheck($mail) {
if (isset($_SESSION['girisyap'])){
echo '<aside class="sidebar pos-absolute z-2"
       data-role="sidebar"
       data-toggle="#sidebar-toggle-3"
       id="sb3"
       data-shift=".shifted-content">';
date_default_timezone_set('Europe/Istanbul');
$tarih = date("d-m");

if($tarih == date('29-10'))
{
echo '<div class="sidebar-header" data-image="https://data.pixiz.com/output/user/frame/preview/400x400/5/6/3/9/2869365_eb3e7.jpg">
<div class="avatar">
<img data-role="gravatar" data-email="alicangonullu@yahoo.com">
</div>
<span style="background-color: rgb(0,0,0);background-color: rgba(0,0,0, 0.4);width:45%;"  class="title fg-white">Ali Can Gönüllü</span>
</div>';
}
elseif($tarih == date('10-11')) {
echo '<div class="sidebar-header" data-image="https://data.pixiz.com/output/user/frame/preview/400x400/5/6/3/9/2869365_eb3e7.jpg>
<div class="avatar">
<img data-role="gravatar" data-email="alicangonullu@yahoo.com">
</div>
<span style="background-color: rgb(0,0,0);background-color: rgba(0,0,0, 0.4);width:45%;"  class="title fg-white">Ali Can Gönüllü</span>
</div>';
} 
elseif($tarih == date('30-08')) {
echo '<div class="sidebar-header" data-image="https://data.pixiz.com/output/user/frame/preview/400x400/5/6/3/9/2869365_eb3e7.jpg">
<div class="avatar">
<img data-role="gravatar" data-email="alicangonullu@yahoo.com">
</div>
<span style="background-color: rgb(0,0,0);background-color: rgba(0,0,0, 0.4);width:45%;"  class="title fg-white">Ali Can Gönüllü</span>
</div>';
} else {
echo '<div class="sidebar-header" data-image="https://metroui.org.ua/images/sb-bg-1.jpg">
<div class="avatar">
<img data-role="gravatar" data-email="alicangonullu@yahoo.com">
</div>
<span style="background-color: rgb(0,0,0);background-color: rgba(0,0,0, 0.4);width:45%;"  class="title fg-white">Ali Can Gönüllü</span>
</div>';
}

echo '
    <ul class="sidebar-menu">
        <li><a href="index.php?git=index"><span class="mif-home icon"></span>Home</a></li>
        <li><a href="index.php?git=admin"><span class="mif-user icon"></span>Admin</a></li>
        <li><a href="index.php?git=update"><span class="mif-cloud-upload icon"></span>Update</a></li>
        <li><a href="index.php?git=loglar"><span class="mif-file-text icon"></span>Logs</a></li>
        <li><a href="index.php?git=cikis"><span class="mif-exit icon"></span>Exit</a></li>
        <li class="divider"></li>
        <li><a href="index.php?git=kuralekle"><span class="mif-add icon"></span>Add Rule</a></li>
		<li><a href="index.php?git=ipekle"><span class="mif-add icon"></span>Add Blocked IP</a></li>
		<li><a href="index.php?git=methodekle"><span class="mif-add icon"></span>Add Method</a></li>
    </ul>
</aside>
<div class="shifted-content h-100 p-ab">
    <div class="app-bar pos-absolute bg-red z-1" data-role="appbar">
        <button class="app-bar-item c-pointer" id="sidebar-toggle-3">
            <span class="mif-menu fg-white"></span>
        </button>
    </div>';
$json = file_get_contents("".$update."server_upd.json");
$obj = json_decode($json, true);
if(empty($obj["guncelleme_numarasi"])) {
?>
<script>
var notify = Metro.notify;
notify.setup({
width: 300,
duration: 1000,
animation: 'easeOutBounce'
});

document.write("<input type='hidden'>");
notify.create("Versiyon Bilgisi Eksiktir!");
notify.reset();
</script>
<?php
} else {
?>
<script>
var data = '<?php echo trim(file_get_contents("guncelleme.json")); ?>';

var alert1 = 'Sisteminiz günceldir.';
var alert2 = 'Sisteminiz için bir güncelleme bulunmaktadır.';

var notify = Metro.notify;
notify.setup({
width: 300,
duration: 1000,
animation: 'easeOutBounce'
});

var json = JSON.parse(data);
if(json["guncelleme_kodu"] >= <?php echo $obj["guncelleme_numarasi"]; ?>) {
document.write("<input type='hidden'>");
notify.create(alert1);
notify.reset();
} else {
document.write("<input type='hidden'>");
notify.create(alert2);
notify.reset();
}
</script>
<?php
}

} else {
die(header('Location: index.php'));	
}
}
function reel_ip()  
{  
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

if(!isset($_GET['git'])) {
$sayfa = 'giris';	// eğer boşsa anasayfa varsayalım.
} else {
   $sayfa = $_GET['git'];
}
switch($sayfa) {

case 'giris':
echo '<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="logo.png"></a>
  <div class="header-right">
    <a class="active" href="index.php">Ana Sayfa</a>
    <a href="index.php?git=login">Giriş</a>
  </div>
</div><br>';
echo '<div style="padding-left:20px">
  <h1>pH Analyzer | AliWAF</h1>
  <p>WAF Yönetimi için <a href="index.php?git=login">tıklayın</a>.</p>
</div>
<hr></hr>
<div style="padding-left:20px">
  <h1>pH Analyzer Nedir ?</h1>
  <p>Kurumsal şirketler için progrqam tabanlı bir siber güvenlik aracıdır.</p>
</div>';
break;

case 'login':
echo '<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="logo.png"></a>
  <div class="header-right">
    <a href="index.php">Ana Sayfa</a>
    <a class="active" href="index.php?git=login">Giriş</a>
  </div>
</div><br>

<br>
<div class="simple-login-container">
<h2>pH Analyzer | AliWAF Login</h2><br>
<form action="index.php?git=loginkontrol" method="post">
<div class="row">
<div class="col-md-12 form-group">
<p>Kullanıcı Adı : <input data-role="input"  type="text" name="user" placeholder="Kullanıcı Adı"></p></div></div>
<div class="row">
<div class="col-md-12 form-group">
<p>Şifre : <input data-role="keypad"  type="password" name="pass" placeholder="Şifre"></p></div></div><br>
<input type="hidden" name="csrf" value="'.$_SESSION["csrf"].'">
<p><div class="row">
<div class="col-md-12 form-group">
<button class="btn btn-block btn-login">Giriş</button></p></div><br>
</form>
</div>
<div class="col-md-12 form-group">
<a href="index.php?git=sifirla" class="btn btn-block btn-login">Sıfırla</a></div>
</div>';
break;
 
case 'loginkontrol':
if($_POST) {

$query  = $aliwaf->query("SELECT * FROM admin_bilgi WHERE kadi = ".$aliwaf->quote(strip_tags($_POST["user"])) . " && passwd = " . $aliwaf->quote(strip_tags(sha1(md5($_POST['pass'])))) . "",PDO::FETCH_ASSOC);
if ( $say = $query -> rowCount() ){
if( $say > 0 ){
session_start();
session_regenerate_id();
$_SESSION['girisyap'] = time() + 1800;
$_SESSION['kullanici_adi']= $name;
$_SESSION['girisyap']=true; 
header('Location: index.php?git=index');
}
}else{
echo '<meta name="viewport" content="width=device-width, initial-scale=1">
<p>HATA: Oturum Açılamadı!</p>';
header('Location: index.php?git=login');
die();
}

} else {
die('<meta name="viewport" content="width=device-width, initial-scale=1">
<center><p>HATA: Oturum Açılamadı!</p></center>');
}
break;

case 'index':
LoginCheck(strip_tags($_SESSION['kullanici_adi']));

echo '<div class="container">
<br><h3>WAF Durumu</h3>';
$ayarid = 1;
try {
$stmt = $aliwaf->prepare('SELECT * FROM waf_ayar WHERE waf_aktif = '.$aliwaf->quote($ayarid).' ORDER BY ayar_id DESC');
$stmt->execute();
while($row = $stmt->fetch()){
if($row['oto_ban'] == 1) {
echo '<div class="alert alert-success"><strong>Otomatik IP Ban : AÇIK (1)</strong></div><br>';
} else {
echo '<div class="alert alert-danger"><strong>Otomatik IP Ban : KAPALI (0)</strong></div><br>';
}
if($row['waf_aktif'] == 1) {
echo '<div class="alert alert-success"><strong>WAF : AKTIF (1)</strong></div><br>';
} else {
echo '<div class="alert alert-danger"><strong>WAF : PASIF (0)</strong></div><br>';
}
if ($row['debug'] == 1){
echo '<td><div class="alert alert-success"><strong>DEBUG : Aktif</strong></div></td>';
} else {
echo '<td><div class="alert alert-danger"><strong>DEBUG : Pasif</strong></div></td>';
}
if($row['ayar_aktif'] == 1) {
echo '<div class="alert alert-success"><strong>AYAR : AÇIK (1)</strong></div><br>';
} else {
echo '<div class="alert alert-danger"><strong>AYAR : KAPALI (0)</strong></div><br>';
}	
}
} catch(PDOException $e) {
echo $e->getMessage();
}
echo '<div class="alert alert-success"><strong>IP Adresiniz : '.strip_tags(reel_ip()).'</strong></div><br>';
echo '</div>
<div class="container">
<table class="table">
<thead>
<br><h3>Rules</h3>
<tr>
<th></th>
<th>Rule ID</th>
<th>Rule Name</th>
</tr></thead><tbody>';

try {
$stmt = $aliwaf->query('SELECT * FROM guard_watch ORDER BY kural_id DESC');
while($row = $stmt->fetch()){

echo '<tr>
<td><a class="button button3" href="javascript:kuralsil('.intval($row['kural_id']).')">Sil</a></td>
<td>'.strip_tags($row['kural_id']).'</td>
<td>'.strip_tags($row['kural_adi']).'</td>
<td><a href="index.php?git=kuralduzenle&id='.intval($row['kural_id']).'">Edit</a></td>
</tr>
';
}
} catch(PDOException $e) {
echo $e->getMessage();
}
?>
</tbody></table></div>
<script language="JavaScript" type="text/javascript">
function kuralsil(id)
{
  if (confirm("Silmek istediğinize emin misiniz : " + id ))
  {
      window.location.href = 'index.php?git=kuralsil&sil=' + id;
  }
}
</script>
<?php


echo '
<div class="container">
<table class="table">
<thead>
<br><h3>Connection Methods</h3>
<tr>
<th></th>
<th>ID</th>
<th>Method Name</th>
<th>Type</th>
</tr></thead><tbody>';

try {
$stmt = $aliwaf->query('SELECT * FROM method_blok ORDER BY method_id DESC');
while($row = $stmt->fetch()){
echo '<tr>
<td><a class="button button3" href="javascript:delmethod('.intval($row['method_id']).')">Sil</a></td>
<td>'.strip_tags($row['method_id']).'</td>
<td>'.strip_tags($row['method_adi']).'</td>
<td>'.strip_tags($row['method_turu']).'</td>
<td><a href="index.php?git=methodduzenle&id='.strip_tags($row['method_id']).'">Edit</a></td>
</tr>';	
}
} catch(PDOException $e) {
echo $e->getMessage();
}
?>
</tbody></table></div>
<script language="JavaScript" type="text/javascript">
function delmethod(id)
{
  if (confirm("Silmek istediğinize emin misiniz : " + id ))
  {
      window.location.href = 'index.php?git=methodsil&sil=' + id;
  }
}
</script>
<?php

echo '<div class="container">
<table class="table">
<thead>
<br><h3>IP Address</h3>
<tr>
<th></th>
<th>ID</th>
<th>IP</th>
</tr></thead><tbody>';

try {
$stmt = $aliwaf->query('SELECT * FROM ip_ban ORDER BY ip_id DESC');
while($row = $stmt->fetch()){
echo '<tr>
<td><a class="button button3" href="javascript:delip('.intval($row['ip_id']).')">Sil</a></td>
<td>'.strip_tags($row['ip_id']).'</td>
<td>'.strip_tags($row['ip_adresi']).'</td>';
echo '
<td><a href="index.php?git=ipduzenle&id='.intval($row['ip_id']).'">Edit</a></td>
</tr>';	
}
} catch(PDOException $e) {
echo $e->getMessage();
}
echo '</tbody></table>
<br><br>
</div>';
?>
<script language="JavaScript" type="text/javascript">
function delip(id)
{
  if (confirm("Silmek istediğinize emin misiniz : " + id ))
  {
      window.location.href = 'index.php?git=ipsil&ipsil=' + id;
  }
}
</script>
<?php
break;

case 'loglar':
$stmt = $aliwaf->prepare('SELECT * FROM admin_bilgi WHERE kadi = :gonderid');
$stmt->execute(array(':gonderid' => $_SESSION['kullanici_adi']));
if($row = $stmt->fetch()) {
$adminid = 0;
if ($row['admin_yetki'] == $adminid){
} else {
echo 'Yetkiniz Yok';
die();  
}
}
LoginCheck(strip_tags($_SESSION['kullanici_adi']));

echo '<div class="container">
<table class="table">
<thead>
<br><h3>Logs</h3>
<tr>
<th>Log ID</th>
<th>Log Name</th>
<th>Log IP</th>
<th>Log URL</th>
</tr></thead><tbody>';
$stmt = $aliwaf->query('SELECT * FROM vuln_log ORDER BY id DESC');
while($row = $stmt->fetch()){
echo '<tr>
<td>'.intval($row["id"]).'</td>
<td>'.strip_tags($row['vuln_name']).'</td>
<td>'.strip_tags($row['vuln_ip']).'</td>
<td>'.strip_tags($row['vuln_url']).'</td>
</tr>'; 
}
echo '</tbody></table></div>';
break;

case 'admin':
$stmt = $aliwaf->prepare('SELECT * FROM admin_bilgi WHERE kadi = :gonderid');
$stmt->execute(array(':gonderid' => $_SESSION['kullanici_adi']));
if($row = $stmt->fetch()) {
$adminid = 0;
if ($row['admin_yetki'] == $adminid){
} else {
echo 'Yetkiniz Yok';
die();	
}
}

LoginCheck(strip_tags($_SESSION['kullanici_adi']));

echo '<div class="container">
<table class="table">
<thead>
<br><h3>Admins</h3>
<tr>
<th>Admin ID</th>
<th>Admin Name</th>
</tr></thead><tbody>';

try {
$stmt = $aliwaf->query('SELECT * FROM admin_bilgi ORDER BY id DESC');
while($row = $stmt->fetch()){
echo '<tr>
<td>'.strip_tags($row['id']).'</td>
<td>'.strip_tags($row['kadi']).'</td>
<td><a class="button" href="index.php?git=adminduzenle&id='.intval($row['id']).'">Edit</a>
</tr>';	
}
} catch(PDOException $e) {
echo $e->getMessage();
}

echo '</tbody></table></div>

<div class="container">
<table class="table">
<br><h3>Configs</h3>
<tr>
<th>Config ID</th>
<th>WAF Status</th>
<th>Auto IP Ban</th>
<th>Debug</th>
<th>Config Name</th>
<th></th>
</tr></thead><tbody>';

try {
$stmt = $aliwaf->query('SELECT * FROM waf_ayar ORDER BY ayar_id DESC');
while($row = $stmt->fetch()){
echo '<tr>
<td>'.intval($row['ayar_id']).'</td>';
$adminid = 1;
if ($row['waf_aktif'] == $adminid){
header('X-AliWAF: ACTIVE');
echo '<td><font color="green">Aktif</font></td>';
} else {
header('X-AliWAF: DEACTIVE');
echo '<td><font color="red">Pasif</font></td>';
}
if ($row['oto_ban'] == $adminid){
header('X-AliWAF: ACTIVE');
echo '<td><font color="green">Aktif</font></td>';
} else {
header('X-AliWAF: DEACTIVE');
echo '<td><font color="red">Pasif</font></td>';
}
if ($row['debug'] == $adminid){
header('X-AliWAF: ACTIVE');
echo '<td><font color="green">Aktif</font></td>';
} else {
header('X-AliWAF: DEACTIVE');
echo '<td><font color="red">Pasif</font></td>';
}
echo '
<td>'.strip_tags($row['ayar_adi']).'</td>';

echo '<td><a class="button" href="index.php?git=ayarduzenle">Edit</a></tr>
</tbody></table></div>';	
}
} catch(PDOException $e) {
echo $e->getMessage();
}
break;

case 'sifirla':
	echo '
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="logo.png"></a>
  <div class="header-right">
    <a href="index.php?git=index">Ana Sayfa</a>
  </div>
</div>';
echo '
<style> 
textarea {
  width: 100%;
  height: 150px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  font-size: 16px;
  resize: none;
}
</style>
<br>
<form class="w3-container" action="index.php?git=sifirlandi" method="post">
<label>E-Mail</label>
<input type="text" name="email" data-role="input" placeholder="E-Mail:"> 
<br>
<label>Token</label>
<input type="text" name="token" data-role="input" placeholder="Token:"> <br>
<input type="submit" value="Gönder" class="w3-button w3-red">
</form>';
break;

case 'sifirlandi':
if (isset($_POST["token"]) && isset($_POST["email"])) {
$email = $_POST["email"];
$token = sha1(md5($_POST["token"]));
$stmt = $aliwaf->query("SELECT * FROM admin_bilgi WHERE email = '$email' AND token = '$token'");
if ($stmt->rowCount() > 0) {
$str = "0123456789qwertzuioplkjhgfdsayxcvbnm";
$str = str_shuffle($str);
$str = substr($str, 0, 15);
$password = sha1(md5($str));
$aliwaf->query("UPDATE admin_bilgi SET passwd = '$password' WHERE email = '$email'");
echo '<meta name="viewport" content="width=device-width, initial-scale=1">
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="logo.png"></a>
  <div class="header-right">
    <a href="index.php?git=index">Ana Sayfa</a>
  </div>
</div>';
echo '<body class="w3-container">
<div class="w3-panel w3-pale-red w3-border">
<h4>Yeni şifren: '.$str.'</h4>
<hr></hr>
<h5>NOT : Şifrenizi Kopyalayın ve <b>BİR YERE KAYDEDİN!</b></h5>
</body>'; 
exit();
 } else {
            echo "Lütfen link yapınızı kontrol ediniz!";
			exit();
        }
    } else {
		echo 'Bir şeyler hatalı';
        exit();
    } 
break;

case 'ipduzenle':
LoginCheck(strip_tags($_SESSION['kullanici_adi']));

    $stmt = $aliwaf->prepare('SELECT * FROM ip_ban WHERE ip_id = :gonderid');
    $stmt->execute(array(':gonderid' => $_GET['id']));
if($row = $stmt->fetch()) {
echo '
<style> 
textarea {
  width: 100%;
  height: 150px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  font-size: 16px;
  resize: none;
}
</style>
<br>
<form class="container" action="index.php?git=ipupd&id='.intval($_GET['id']).'" method="post">
<label>IP Adresi</label>
<input type="text" name="ipadresi" data-role="input" placeholder="IP Adresi:" value="'.$row['ip_adresi'].'"> 
<br><br>
<input type="submit" value="Gönder" class="w3-button w3-red">
</form>';
}
break;

case 'ipupd':
LoginCheck(strip_tags($_SESSION['kullanici_adi']));
$update = $aliwaf->prepare("UPDATE ip_ban SET ip_adresi = :ipadresi  WHERE ip_id = :gonderid ");
$update->bindValue(':gonderid', intval($_GET['id']));
$update->bindValue(':ipadresi', strip_tags($_POST['ipadresi']));
$update->execute();
if($update){
echo '<script>
alert("Başarılı");
window.location.replace("index.php?git=index")
</script>';
}
break;

case 'kuralduzenle':
LoginCheck(strip_tags($_SESSION['kullanici_adi']));

$stmt = $aliwaf->prepare('SELECT * FROM guard_watch WHERE kural_id = :gonderid');
$stmt->execute(array(':gonderid' => intval($_GET['id'])));
if($row = $stmt->fetch()) {
$degis = str_replace("¿¿", ",", $row['kural_icerik']);
echo '
<style> 
textarea {
  width: 100%;
  height: 150px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  font-size: 16px;
  resize: none;
}
</style>
<br>
<form class="mt-5 container" action="index.php?git=kuralpost&id='.intval($_GET['id']).'" method="post">
<label>Rule Name</label>
<input type="text" name="kuraladi" data-role="input" placeholder="Rule Name:" value="'.$row['kural_adi'].'"> 
<br>
<label>Rule</label>
<textarea data-role="taginput" name="kuralicerik" cols="60" rows="10">'.$degis.'</textarea>
<br><br><input type="submit" value="Gönder" class="w3-button w3-red">
</form>';
}	
break;


case 'adminduzenle':
LoginCheck(strip_tags($_SESSION['kullanici_adi']));

$stmt = $aliwaf->prepare('SELECT * FROM admin_bilgi WHERE id = :gonderid');
$stmt->execute(array(':gonderid' => $_GET['id']));
if($row = $stmt->fetch()) {
echo '
<style> 
textarea {
  width: 100%;
  height: 150px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  font-size: 16px;
  resize: none;
}
</style>
<br>
<form class="container" action="index.php?git=kadiupd&id='.$_GET['id'].'" method="post">
<label>Kullanıcı Adı</label>
<input type="text" name="kadi" data-role="input" placeholder="Kullanıcı Adı:" value="'.$row['kadi'].'"> 
<br>
<label>Şifre</label>
<input type="text" name="pass" data-role="input" placeholder="Şifre:"> 
<br>
<label>E-Mail</label>
<input type="text" name="email" data-role="input" placeholder="E-Mail:" value="'.$row['email'].'">
<br>
<label>Token</label>
<input type="text" name="tokens" data-role="input" placeholder="Token:"> 
<br><br>
<input type="submit" value="Gönder" class="w3-button w3-red">
</form>';	
	}
break;
case 'kadiupd':
LoginCheck(strip_tags($_SESSION['kullanici_adi']));
$update = $aliwaf->prepare("UPDATE admin_bilgi SET kadi = :kadi , passwd = :pass , email = :email , token = :token WHERE id = :gonderid ");
$update->bindValue(':gonderid', strip_tags($_GET['id']));
$update->bindValue(':kadi', strip_tags($_POST['kadi']));
$update->bindValue(':pass', strip_tags(sha1(md5($_POST['pass']))));
$update->bindValue(':email', strip_tags($_POST['email']));
$update->bindValue(':token', strip_tags(sha1(md5($_POST['tokens']))));
$update->execute();
if($update){
echo '<script>
alert("Başarılı");
window.location.replace("index.php?git=index")
</script>';
}
break;

case 'ayarduzenle':
LoginCheck(strip_tags($_SESSION['kullanici_adi']));

$stmt = $aliwaf->prepare('SELECT * FROM waf_ayar WHERE ayar_id = :gonderid');
$stmt->execute(array(':gonderid' => "1"));
if($row = $stmt->fetch()) {
echo '
<div class="container">
<style> 
textarea {
  width: 100%;
  height: 150px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  font-size: 16px;
  resize: none;
}

</style>
<br>
<form action="index.php?git=ayarkayit" method="post">
<label>Config Name</label>
<input type="text" name="ayaradi" data-role="input" placeholder="Config Name:" value="'.$row['ayar_adi'].'"> 
<br>
<label>WAF Status</label><br>
<select data-role="select" name="wafdurum" id="wafdurum">
  <option value="1">Active</option>
  <option value="0">Passive</option>
</select>
<br>
<label>Config Status</label><br>
<select data-role="select" name="ayardurum" id="ayardurum">
  <option value="1">Active</option>
  <option value="0">Passive</option>
</select>
<br>
<label>Auto IP Ban</label><br>
<select data-role="select" name="otoban" id="otoban">
  <option value="1">Active</option>
  <option value="0">Passive</option>
</select>
<br>
<label>Debug</label><br>
<select data-role="select" name="debug" id="debug">
  <option value="1">Active</option>
  <option value="0">Passive</option>
</select><br>
<br><input type="submit" value="Save" class="w3-button w3-red">
</form>';
echo '<hr></hr>';
if($row['oto_ban'] == 1) {
	echo '<div class="alert alert-success"><strong>Auto IP Ban : RUNNING (1)</strong></div><br>';
} else {
	echo '<div class="alert alert-danger"><strong>Otomatik IP Ban : NOT RUNNING (0)</strong></div><br>';
}
if($row['waf_aktif'] == 1) {
	echo '<div class="alert alert-success"><strong>WAF : RUNNING (1)</strong></div><br>';
} else {
	echo '<div class="alert alert-danger"><strong>WAF : NOT RUNNING (0)</strong></div><br>';
}
echo '</div>';	
}
break;

case 'ayarkayit':
LoginCheck(strip_tags($_SESSION['kullanici_adi']));
$update = $aliwaf->prepare("UPDATE waf_ayar SET ayar_adi = :ayar_adi , waf_aktif = :waf_aktif , oto_ban = :oto_ban , ayar_aktif = :ayar_aktif, debug = :debug WHERE ayar_id = :gonderid ");
$update->bindValue(':gonderid', strip_tags("1"));
$update->bindValue(':ayar_adi', strip_tags($_POST['ayaradi']));
$update->bindValue(':ayar_aktif', strip_tags($_POST['ayardurum']));
$update->bindValue(':waf_aktif', strip_tags($_POST['wafdurum']));
$update->bindValue(':oto_ban', strip_tags($_POST['otoban']));
$update->bindValue(':debug', strip_tags($_POST['debug']));
$update->execute();
if($update){
echo '<script>
alert("Success");
window.location.replace("index.php?git=index")
</script>';
}
break;

case 'kuralekle':
LoginCheck(strip_tags($_SESSION['kullanici_adi']));
echo '
<style> 
textarea {
  width: 100%;
  height: 150px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  font-size: 16px;
  resize: none;
}
</style>
<br>
<form class="container" action="index.php?git=krlpost" method="post">
<label>Rule Name</label>
<input type="text" name="kuraladi" data-role="input" placeholder="Rule Name:"> 
<label>Rule</label>
<textarea data-role="taginput" name="kuralicerik" cols="60" rows="10" placeholder="Rule:"></textarea>
<br><br><input type="submit" value="Gönder" class="w3-button w3-red">
</form>';	
break;

case 'krlpost':
LoginCheck(strip_tags($_SESSION['kullanici_adi']));		
$degis = str_replace(",", "¿¿", $_POST['kuralicerik']);												
$update = $aliwaf->prepare("INSERT INTO guard_watch(kural_adi, kural_icerik, kural_hakkinda) VALUES (:kuraladi, :kuralicerik, :kuralhk)");
$update->bindValue(':kuraladi', $_POST['kuraladi']);
$update->bindValue(':kuralhk', $_POST['kuraladi']);
$update->bindValue(':kuralicerik', $degis);
$update->execute();
if($update){
echo '<script>
alert("Rule Added");
window.location.replace("index.php?git=index")
</script>';
} else {
echo '<script>
alert("Rule Could Not Added");
window.location.replace("index.php?git=index")
</script>';
}
break;

case 'kuralpost':
LoginCheck(strip_tags($_SESSION['kullanici_adi']));
$degis = str_replace(",", "¿¿", strtolower($_POST['kuralicerik']));
$update = $aliwaf->prepare("UPDATE guard_watch SET kural_adi = :kuraladi, kural_icerik = :kuralicerik, kural_hakkinda = :kuralhk WHERE kural_id = :gonderid ");
$update->bindValue(':gonderid', strip_tags($_GET['id']));
$update->bindValue(':kuraladi', strip_tags($_POST['kuraladi']));
$update->bindValue(':kuralhk', strip_tags($_POST['kuraladi']));
$update->bindValue(':kuralicerik', $degis);
$update->execute();
if($update){
echo '<script>
alert("Başarılı");
window.location.replace("index.php?git=index")
</script>';
}
break;

case 'methodduzenle':
LoginCheck(strip_tags($_SESSION['kullanici_adi']));

$stmt = $aliwaf->prepare('SELECT * FROM method_blok WHERE method_id = :gonderid');
$stmt->execute(array(':gonderid' => intval($_GET['id'])));
if($row = $stmt->fetch()) {
echo '
<style> 
textarea {
  width: 100%;
  height: 150px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  font-size: 16px;
  resize: none;
}
</style>
<br>
<form class="container" action="index.php?git=methodupd&id='.intval($_GET['id']).'" method="post">
<label>Method Name</label>
<input type="text" name="methodadi" data-role="input" placeholder="Method Adı:" value="'.$row['method_adi'].'"> 
<br>
<label>Method Type</label>

<select data-role="input" name="methodicerik" id="methodicerik">
<option selected><font color="red">'.$row['method_turu'].'</font></option> 
  <option value="GET">GET</option>
  <option value="POST">POST</option>
  <option value="PUT">PUT</option>
  <option value="DELETE">DELETE</option>
</select>
<br><br>
<input type="submit" value="Gönder" class="w3-button w3-red">
</form>';
}
break;

case 'methodupd':
LoginCheck(strip_tags($_SESSION['kullanici_adi']));
$update = $aliwaf->prepare("UPDATE method_blok SET method_adi = :method_adi , method_turu = :method_turu WHERE method_id = :gonderid ");
$update->bindValue(':gonderid', intval($_GET['id']));
$update->bindValue(':method_adi', strip_tags($_POST['methodadi']));
$update->bindValue(':method_turu', strip_tags($_POST['methodicerik']));
$update->execute();
if($update){
echo '<script>
alert("Başarılı");
window.location.replace("index.php?git=index")
</script>';
}
break;

case 'ipekle':
LoginCheck(strip_tags($_SESSION['kullanici_adi']));
echo '
<style> 
textarea {
  width: 100%;
  height: 150px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  font-size: 16px;
  resize: none;
}
</style>
<br>
<form class="container" action="index.php?git=ippost" method="post">
<label>IP Address</label>
<input type="text" name="ipadress" data-role="input" placeholder="IP Address:"> 
<br><br>
<input type="submit" value="Gönder" class="w3-button w3-red">
</form>';	
break;

case 'ippost':
LoginCheck(strip_tags($_SESSION['kullanici_adi']));														
$update = $aliwaf->prepare("INSERT INTO ip_ban(ip_adresi, ip_usragent, ip_suresi) VALUES (:ipadresi, :ipusragent, :ipsure) ");
$update->bindValue(':ipadresi', $_POST['ipadress']);
$update->bindValue(':ipusragent', "panel");
$update->bindValue(':ipsure', date('H:i:s'));
$update->execute();
if($update){
echo '<script>
alert("IP Added");
window.location.replace("index.php?git=index")
</script>';
} else {
echo '<script>
alert("IP Could Not Added");
window.location.replace("index.php?git=index")
</script>';
}
break;

case 'methodekle':
LoginCheck(strip_tags($_SESSION['kullanici_adi']));
echo '
<style> 
textarea {
  width: 100%;
  height: 150px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  font-size: 16px;
  resize: none;
}
</style>
<br>
<form class="container" action="index.php?git=methodpost" method="post">
<label>Method Name</label>
<input type="text" name="methodadi" data-role="input" placeholder="Method Name:"> 
<br>
<label>Method Type</label>
<select data-role="input" name="methodicerik" id="methodicerik">
  <option value="GET">GET</option>
  <option value="POST">POST</option>
  <option value="PUT">PUT</option>
  <option value="DELETE">DELETE</option>
</select><br><br>
<input type="submit" value="Gönder" class="w3-button w3-red">
</form>';	
break;

case 'methodpost':
LoginCheck(strip_tags($_SESSION['kullanici_adi']));
$update = $aliwaf->prepare("INSERT INTO method_blok(method_adi, method_turu, method_bilgisi) VALUES (:methodadi, :methodicerik, :methodbilgi) ");
$update->bindValue(':methodadi', $_POST['methodadi']);
$update->bindValue(':methodbilgi', $_POST['methodadi']);
$update->bindValue(':methodicerik', $_POST['methodicerik']);
$update->execute();
if($update){
echo '<script>
alert("Method Added");
window.location.replace("index.php?git=index")
</script>';
} else {
echo '<script>
alert("Method Could Not Added");
window.location.replace("index.php?git=index")
</script>';
}
break;


case 'ipsil':
LoginCheck(strip_tags($_SESSION['kullanici_adi']));
if(isset($_GET['ipsil'])){ 
$stmt = $aliwaf->prepare('DELETE FROM ip_ban WHERE ip_id = :postID') ;
$stmt->execute(array(':postID' => intval($_GET['ipsil'])));
if($stmt){
echo '<script>
alert("IP Deleted");
window.location.replace("index.php?git=index")
</script>';
} else {
echo '<script>
alert("IP Could Not Deleted");
window.location.replace("index.php?git=index")</script>';
}
}
break;

case 'kuralsil':
LoginCheck(strip_tags($_SESSION['kullanici_adi']));
if(isset($_GET['sil'])){ 
$stmt = $aliwaf->prepare('DELETE FROM guard_watch WHERE kural_id = :postID') ;
$stmt->execute(array(':postID' => intval($_GET['sil'])));
if($stmt){
echo '<script>
alert("Rule Deleted");
window.location.replace("index.php?git=index")
</script>';
} else {
echo '<script>
alert("Rule Could Not Deleted");
window.location.replace("index.php?git=index")</script>';
}
}
break;

case 'methodsil':
LoginCheck(strip_tags($_SESSION['kullanici_adi']));
if(isset($_GET['sil'])){ 
$stmt = $aliwaf->prepare('DELETE FROM method_blok WHERE method_id = :postID') ;
$stmt->execute(array(':postID' => intval($_GET['sil'])));
if($stmt){
echo '<script>
alert("Method Deleted");
window.location.replace("index.php?git=index")
</script>';
} else {
echo '<script>
alert("Method Could Not Deleted");
window.location.replace("index.php?git=index")</script>';
}
}
break;

case 'update':
LoginCheck(strip_tags($_SESSION['kullanici_adi']));
$updateserver = json_decode(file_get_contents("".$update."server_upd.json"), true);
$get = json_decode(file_get_contents("guncelleme.json"), true);
echo "<br><div class='text-center container card'>
<br>
<div class='info-box-content'>
<b> Version : ".$get["guncelleme_kodu"]." </b><br>
<b> Date : ".$get["guncelleme_tarih"]." </b><br>
<b> Version Name : ".$get["guncelleme_adi"]." </b><br>
</div><br>";
if($get["guncelleme_kodu"] < $updateserver["guncelleme_numarasi"]) {
echo "<div class='info-box-content'>
<b> New Version : ".$updateserver["guncelleme_numarasi"]." </b><br>
<b> Date : ".$updateserver["guncelleme_tarihi"]." </b><br>
<b> New Version Name : ".$updateserver["guncelleme_adi"]." </b><br>
</div><br>
<a href='".$updateserver["guncelleme_link"]."' class='button'>Update</a><br><br>";
} else {
echo "<div class='info-box-content'><b>Your system has been updated</b><br></div><br>";
}
echo '</div>';
break;

case 'cikis':
session_destroy();
echo (" OK ");
header ("Location:index.php"); 
break;
}
?>
