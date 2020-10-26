<?php
session_start();
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="description" content="pH Analyzer">      
	<style>
* {box-sizing: border-box;}

body { 
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

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
    background-color:#5286F3;
    font-size:14px;
    color:#FF5964;
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
    color:#FF5964;
}
</style>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
	<title>pH Analyzer | AliWAF</title>  
</head>
<?php
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
error_reporting(0);
try {
$ip = "localhost"; //host
$user = "root";  // host id
$password = "19742008";  // password local olduğu için varsayılan şifre
$dbad = "ali_waf"; // db adı
	
     $db = new PDO("mysql:host=$ip;dbname=$dbad", "$user", "$password");
     $db->query("SET CHARACTER SET 'utf8'");
     $db->query("SET NAMES 'utf8'");

} catch ( PDOException $e ){
     echo '
	 <table>
<center><img src="./sql.png" alt="Örnek Resim"/></center>
<center>No MySQL Connection</center>
<center>Bunun Sebebi Bir DDoS Saldırısı Olabilir</center>
<center>Sistem Yöneticinizle Irtibata Geçin</center>
	 </table>';
	 die();
}
if(!isset($_GET['git'])) {
$sayfa = 'giris';	// eğer boşsa anasayfa varsayalım.
} else {
   $sayfa = $_GET['git'];
}
switch($sayfa) {

case 'giris':
echo '<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.info/goruntu/153"></a>
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
session_start();
if (isset($_SESSION['girisyap'])){
		header('Location: index.php?git=index');
} else {	
}
echo '<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.info/goruntu/153"></a>
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
<p>Kullanıcı Adı : <input class="form-control"  type="text" name="user" placeholder="Kullanıcı Adı"></p></div></div>
<div class="row">
<div class="col-md-12 form-group">
<p>Şifre : <input class="form-control"  type="password" name="pass" placeholder="Şifre"></p></div></div><br>
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
$query  = $db->query("SELECT * FROM admin_bilgi WHERE kadi = ".$db->quote(strip_tags($_POST["user"])) . " && passwd = " . $db->quote(strip_tags(sha1(md5($_POST['pass'])))) . "",PDO::FETCH_ASSOC);
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
break;

case 'index':
session_start();
if (isset($_SESSION['girisyap'])){
} else {	
	header('Location: index.php?git=login');
}
echo '
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.info/goruntu/153"></a>
  <div class="header-right">
    <a class="active" href="index.php?git=index">Ana Sayfa</a>
	<a href="index.php?git=admin">Admin</a>
	<a href="index.php?git=kuralekle">Kural Ekle</a>
	<a href="index.php?git=ipekle">IP Ekle</a>
	<a href="index.php?git=methodekle">Method Ekle</a>
    <a href="index.php?git=cikis">Çıkış</a>
  </div>
</div>';

echo '<div class="w3-container">
<br><h3>WAF Durumu</h3>';
$ayarid = 1;
try {
$stmt = $db->prepare('SELECT * FROM waf_ayar WHERE waf_aktif = '.$ayarid.' ORDER BY ayar_id DESC');
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

if($row['ayar_aktif'] == 1) {
echo '<div class="alert alert-success"><strong>AYAR : AÇIK (1)</strong></div><br>';
} else {
echo '<div class="alert alert-danger"><strong>AYAR : KAPALI (0)</strong></div><br>';
}	
}
} catch(PDOException $e) {
echo $e->getMessage();
}
echo '<div class="alert alert-success"><strong>IP Adresiniz : '.reel_ip().'</strong></div><br>';
echo '</div>
<div class="w3-container">
<table class="w3-table w3-striped">
<br><h3>Kurallar</h3>
<tr>
<th></th>
<th>Kural ID</th>
<th>Kural Adı</th>
</tr>';

try {
$stmt = $db->query('SELECT * FROM guard_watch ORDER BY kural_id DESC');
while($row = $stmt->fetch()){
echo '<tr>
<td><a class="button button3" href="javascript:kuralsil('.$row['kural_id'].')">Sil</a></td>
<td>'.strip_tags($row['kural_id']).'</td>
<td>'.strip_tags($row['kural_adi']).'</td>
<td><a href="index.php?git=kuralduzenle&id='.strip_tags($row['kural_id']).'">Düzenle</a></td>
</tr>
</div>';
}
} catch(PDOException $e) {
echo $e->getMessage();
}
?>
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


echo '<div class="w3-container">
<table class="w3-table w3-striped">
<br><h3>Izin Verilen Methodlar</h3>
<tr>
<th></th>
<th>ID</th>
<th>Method Adı</th>
<th>Türü</th>
</tr>';

try {
$stmt = $db->query('SELECT * FROM method_blok ORDER BY method_id DESC');
while($row = $stmt->fetch()){
echo '<tr>
<td><a class="button button3" href="javascript:delmethod('.$row['method_id'].')">Sil</a></td>
<td>'.strip_tags($row['method_id']).'</td>
<td>'.strip_tags($row['method_adi']).'</td>
<td>'.strip_tags($row['method_turu']).'</td>
<td><a href="index.php?git=methodduzenle&id='.strip_tags($row['method_id']).'">Düzenle</a></td>
</tr>
</div>';	
}
} catch(PDOException $e) {
echo $e->getMessage();
}
?>
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

echo '<div class="w3-container">
<table class="w3-table w3-striped">
<br><h3>IP Adresleri</h3>
<tr>
<th></th>
<th>ID</th>
<th>Adresi</th>
</tr>';

try {
$stmt = $db->query('SELECT * FROM ip_ban ORDER BY ip_id DESC');
while($row = $stmt->fetch()){
echo '<tr>
<td><a class="button button3" href="javascript:delip('.$row['ip_id'].')">Sil</a></td>
<td>'.strip_tags($row['ip_id']).'</td>
<td>'.strip_tags($row['ip_adresi']).'</td>';
echo '
<td><a href="index.php?git=ipduzenle&id='.strip_tags($row['ip_id']).'">Düzenle</a></td>';	
}
} catch(PDOException $e) {
echo $e->getMessage();
}
echo '
</tr>
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

case 'admin':
$stmt = $db->prepare('SELECT * FROM admin_bilgi WHERE kadi = :gonderid');
$stmt->execute(array(':gonderid' => $_SESSION['kullanici_adi']));
if($row = $stmt->fetch()) {
$adminid = 0;
if ($row['admin_yetki'] == $adminid){
} else {
echo 'Yetkiniz Yok';
die();	
}
}

session_start();
if (isset($_SESSION['girisyap'])){
} else {	
	header('Location: index.php?git=login');
}
echo '
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.info/goruntu/153"></a>
  <div class="header-right">
    <a href="index.php?git=index">Ana Sayfa</a>
	<a class="active" href="index.php?git=admin">Admin</a>
    <a href="index.php?git=cikis">Çıkış</a>
  </div>
</div>';

echo '<div class="w3-container">
<table class="w3-table w3-striped">
<br><h3>Adminler</h3>
<tr>
<th>Admin ID</th>
<th>Admin Adı</th>
</tr>';

try {
$stmt = $db->query('SELECT * FROM admin_bilgi ORDER BY id DESC');
while($row = $stmt->fetch()){
echo '<tr>
<td>'.strip_tags($row['id']).'</td>
<td>'.strip_tags($row['kadi']).'</td>
<td><a href="index.php?git=adminduzenle&id='.strip_tags($row['id']).'">Düzenle</a> | 
</tr>
</div>';	
}
} catch(PDOException $e) {
echo $e->getMessage();
}

echo '<div class="w3-container">
<table class="w3-table w3-striped">
<br><h3>Ayarlar</h3>
<tr>
<th>Ayar ID</th>
<th>WAF Durum</th>
<th>Oto IP Ban</th>
<th>Ayar Adı</th>
<th></th>
</tr>';

try {
$stmt = $db->query('SELECT * FROM waf_ayar ORDER BY ayar_id DESC');
while($row = $stmt->fetch()){
echo '<tr>
<td>'.strip_tags($row['ayar_id']).'</td>';
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
echo '
<td>'.strip_tags($row['ayar_adi']).'</td>';
echo '<td><a href="index.php?git=ayarduzenle&id='.strip_tags($row['ayar_id']).'">Düzenle</a></tr>
</div>';	
}
} catch(PDOException $e) {
echo $e->getMessage();
}
break;

case 'sifirla':
	echo '
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.info/goruntu/153"></a>
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
<input type="text" name="email" class="form-control" placeholder="E-Mail:"> 
<br>
<label>Token</label>
<input type="text" name="token" class="form-control" placeholder="Token:"> <br>
<input type="submit" value="Gönder" class="w3-button w3-red">
</form>';
break;

case 'sifirlandi':
if (isset($_POST["token"]) && isset($_POST["email"])) {
$email = $_POST["email"];
$token = sha1(md5($_POST["token"]));
$stmt = $db->query("SELECT * FROM admin_bilgi WHERE email = '$email' AND token = '$token'");
if ($stmt->rowCount() > 0) {
$str = "0123456789qwertzuioplkjhgfdsayxcvbnm";
$str = str_shuffle($str);
$str = substr($str, 0, 15);
$password = sha1(md5($str));
$db->query("UPDATE admin_bilgi SET passwd = '$password' WHERE email = '$email'");
echo '<meta name="viewport" content="width=device-width, initial-scale=1">
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.info/goruntu/153"></a>
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
session_start();
if (isset($_SESSION['girisyap'])){
} else {	
	header('Location: index.php?git=login');
}
echo '
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.info/goruntu/153"></a>
  <div class="header-right">
    <a href="index.php?git=uygulamayap">Ana Sayfa</a>
  </div>
</div>';

    $stmt = $db->prepare('SELECT * FROM ip_ban WHERE ip_id = :gonderid');
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
<form class="w3-container" action="index.php?git=ipupd&id='.$_GET['id'].'" method="post">
<label>IP Adresi</label>
<input type="text" name="ipadresi" class="form-control" placeholder="IP Adresi:" value="'.$row['ip_adresi'].'"> 
<br><br>
<input type="submit" value="Gönder" class="w3-button w3-red">
</form>';
}
break;

case 'ipupd':
session_start();
if (isset($_SESSION['girisyap'])){
	echo '
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.info/goruntu/153"></a>
  <div class="header-right">
    <a href="index.php?git=index">Ana Sayfa</a>
  </div>
</div>';
} else {	
	header('Location: index.php?git=login');
}
$update = $db->prepare("UPDATE ip_ban SET ip_adresi = :ipadresi  WHERE ip_id = :gonderid ");
$update->bindValue(':gonderid', strip_tags($_GET['id']));
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
session_start();
if (isset($_SESSION['girisyap'])){
	echo '
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.info/goruntu/153"></a>
  <div class="header-right">
    <a href="index.php?git=index">Ana Sayfa</a>
  </div>
</div>';
} else {	
	header('Location: index.php?git=login');
}

$stmt = $db->prepare('SELECT * FROM guard_watch WHERE kural_id = :gonderid');
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
<form class="w3-container" action="index.php?git=kuralpost&id='.$_GET['id'].'" method="post">
<label>Kural Adı</label>
<input type="text" name="kuraladi" class="form-control" placeholder="Kural Adı:" value="'.$row['kural_adi'].'"> 
<br>
<label>Kural İçeriği</label>
<textarea name="kuralicerik" cols="60" rows="10">'.$row['kural_icerik'].'</textarea>
<br><input type="submit" value="Gönder" class="w3-button w3-red">
</form>';
}	
break;


case 'adminduzenle':
session_start();
if (isset($_SESSION['girisyap'])){
	echo '
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.info/goruntu/153"></a>
  <div class="header-right">
    <a href="index.php?git=index">Ana Sayfa</a>
  </div>
</div>';
} else {	
	header('Location: index.php?git=login');
}

$stmt = $db->prepare('SELECT * FROM admin_bilgi WHERE id = :gonderid');
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
<form class="w3-container" action="index.php?git=kadiupd&id='.$_GET['id'].'" method="post">
<label>Kullanıcı Adı</label>
<input type="text" name="kadi" class="form-control" placeholder="Kullanıcı Adı:" value="'.$row['kadi'].'"> 
<br>
<label>Şifre</label>
<input type="text" name="pass" class="form-control" placeholder="Şifre:"> 
<br>
<label>E-Mail</label>
<input type="text" name="email" class="form-control" placeholder="E-Mail:" value="'.$row['email'].'">
<br>
<label>Token</label>
<input type="text" name="tokens" class="form-control" placeholder="Token:"> 
<br>
<input type="submit" value="Gönder" class="w3-button w3-red">
</form>';	
	}
break;
case 'kadiupd':
session_start();
if (isset($_SESSION['girisyap'])){
	echo '
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.info/goruntu/153"></a>
  <div class="header-right">
    <a href="index.php?git=index">Ana Sayfa</a>
  </div>
</div>';
} else {	
	header('Location: index.php?git=login');
}
$update = $db->prepare("UPDATE admin_bilgi SET kadi = :kadi , passwd = :pass , email = :email , token = :token WHERE id = :gonderid ");
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
session_start();
if (isset($_SESSION['girisyap'])){
	echo '
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.info/goruntu/153"></a>
  <div class="header-right">
    <a href="index.php?git=index">Ana Sayfa</a>
  </div>
</div>';
} else {	
	header('Location: index.php?git=login');
}

    $stmt = $db->prepare('SELECT * FROM waf_ayar WHERE ayar_id = :gonderid');
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
<form class="w3-container" action="index.php?git=ayarkayit&id='.$_GET['id'].'" method="post">
<label>Ayar Adı</label>
<input type="text" name="ayaradi" class="form-control" placeholder="Ayar Adı:" value="'.$row['ayar_adi'].'"> 
<br>
<label>WAF Durumu</label><br>
<label><input type="checkbox" name="wafdurum"value="1">Aktif</label><br>
<label><input type="checkbox" name="wafdurum" value="0">Pasif</label><br>
<br>
<label>Ayar Durumu</label><br>
<label><input type="checkbox" name="ayardurum"value="1">Aktif</label><br>
<label><input type="checkbox" name="ayardurum" value="0">Pasif</label><br>
<br>
<label>Otomatik IP Ban</label><br>
<label><input type="checkbox" name="otoban" value="1">Aktif</label><br>
<label><input type="checkbox" name="otoban" value="0">Pasif</label><br>
<br><input type="submit" value="Gönder" class="w3-button w3-red">
</form>';
echo '<hr></hr>';
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
	}
break;

case 'ayarkayit':
session_start();
if (isset($_SESSION['girisyap'])){
	echo '
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.info/goruntu/153"></a>
  <div class="header-right">
    <a href="index.php?git=index">Ana Sayfa</a>
  </div>
</div>';
} else {	
	header('Location: index.php?git=login');
}
$update = $db->prepare("UPDATE waf_ayar SET ayar_adi = :ayar_adi , waf_aktif = :waf_aktif , oto_ban = :oto_ban , ayar_aktif = :ayar_aktif WHERE ayar_id = :gonderid ");
$update->bindValue(':gonderid', strip_tags($_GET['id']));
$update->bindValue(':ayar_adi', strip_tags($_POST['ayaradi']));
$update->bindValue(':ayar_aktif', strip_tags($_POST['ayardurum']));
$update->bindValue(':waf_aktif', strip_tags($_POST['wafdurum']));
$update->bindValue(':oto_ban', strip_tags($_POST['otoban']));
$update->execute();
if($update){
echo '<script>
alert("Başarılı");
window.location.replace("index.php?git=index")
</script>';
}
break;

case 'kuralekle':
session_start();
if (isset($_SESSION['girisyap'])){
	echo '
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.info/goruntu/153"></a>
  <div class="header-right">
    <a href="index.php?git=index">Ana Sayfa</a>
  </div>
</div>';
} else {	
	header('Location: index.php?git=login');
}
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
<form class="w3-container" action="index.php?git=krlpost" method="post">
<label>Kural Adı</label>
<input type="text" name="kuraladi" class="form-control" placeholder="Kural Adı:"> 
<br>
<label>Kural İçeriği</label>
<textarea name="kuralicerik" cols="60" rows="10" placeholder="Kural İçeriği:"></textarea>
<br><input type="submit" value="Gönder" class="w3-button w3-red">
</form>';	
break;

case 'krlpost':
session_start();
if (isset($_SESSION['girisyap'])){
	echo '
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.info/goruntu/153"></a>
  <div class="header-right">
    <a href="index.php?git=index">Ana Sayfa</a>
  </div>
</div>';
} else {	
	header('Location: index.php?git=login');
}														
$update = $db->prepare("INSERT INTO guard_watch(kural_adi, kural_icerik, kural_hakkinda) VALUES (:kuraladi, :kuralicerik, :kuralhk)");
$update->bindValue(':kuraladi', $_POST['kuraladi']);
$update->bindValue(':kuralhk', $_POST['kuraladi']);
$update->bindValue(':kuralicerik', $_POST['kuralicerik']);
$update->execute();
if($update){
echo '<script>
alert("Kural Eklendi");
window.location.replace("index.php?git=index")
</script>';
} else {
echo '<script>
alert("Kural Eklenemedi");
window.location.replace("index.php?git=index")
</script>';
}
break;

case 'kuralpost':
session_start();
if (isset($_SESSION['girisyap'])){
	echo '
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.info/goruntu/153"></a>
  <div class="header-right">
    <a href="index.php?git=index">Ana Sayfa</a>
  </div>
</div>';
} else {	
	header('Location: index.php?git=login');
}
$update = $db->prepare("UPDATE guard_watch SET kural_adi = :kuraladi, kural_icerik = :kuralicerik, kural_hakkinda = :kuralhk WHERE kural_id = :gonderid ");
$update->bindValue(':gonderid', strip_tags($_GET['id']));
$update->bindValue(':kuraladi', strip_tags($_POST['kuraladi']));
$update->bindValue(':kuralhk', strip_tags($_POST['kuraladi']));
$update->bindValue(':kuralicerik', strip_tags($_POST['kuralicerik']));
$update->execute();
if($update){
echo '<script>
alert("Başarılı");
window.location.replace("index.php?git=index")
</script>';
}
break;

case 'methodduzenle':
session_start();
if (isset($_SESSION['girisyap'])){
	echo '
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.info/goruntu/153"></a>
  <div class="header-right">
    <a href="index.php?git=index">Ana Sayfa</a>
  </div>
</div>';
} else {	
	header('Location: index.php?git=login');
}



$stmt = $db->prepare('SELECT * FROM method_blok WHERE method_id = :gonderid');
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
<form class="w3-container" action="index.php?git=methodupd&id='.$_GET['id'].'" method="post">
<label>Method Adı</label>
<input type="text" name="methodadi" class="form-control" placeholder="Method Adı:" value="'.$row['method_adi'].'"> 
<br>
<label>Method İçeriği</label>
<input type="text" name="methodicerik" class="form-control" placeholder="Method İçeriği:" value="'.$row['method_turu'].'"> 
<br><input type="submit" value="Gönder" class="w3-button w3-red">
</form>';
}
break;

case 'methodupd':
session_start();
if (isset($_SESSION['girisyap'])){
	echo '
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.info/goruntu/153"></a>
  <div class="header-right">
    <a href="index.php?git=index">Ana Sayfa</a>
  </div>
</div>';
} else {	
	header('Location: index.php?git=login');
}
$update = $db->prepare("UPDATE method_blok SET method_adi = :method_adi , method_turu = :method_turu WHERE method_id = :gonderid ");
$update->bindValue(':gonderid', strip_tags($_GET['id']));
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
session_start();
if (isset($_SESSION['girisyap'])){
	echo '
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.info/goruntu/153"></a>
  <div class="header-right">
    <a href="index.php?git=index">Ana Sayfa</a>
  </div>
</div>';
} else {	
	header('Location: index.php?git=login');
}
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
<form class="w3-container" action="index.php?git=ippost" method="post">
<label>IP Adresi</label>
<input type="text" name="ipadress" class="form-control" placeholder="IP Adresi:"> 
<br>
<input type="submit" value="Gönder" class="w3-button w3-red">
</form>';	
break;

case 'ippost':
session_start();
if (isset($_SESSION['girisyap'])){
	echo '
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.info/goruntu/153"></a>
  <div class="header-right">
    <a href="index.php?git=index">Ana Sayfa</a>
  </div>
</div>';
} else {	
	header('Location: index.php?git=login');
}														
$update = $db->prepare("INSERT INTO ip_ban(ip_adresi, ip_usragent, ip_suresi) VALUES (:ipadresi, :ipusragent, :ipsure) ");
$update->bindValue(':ipadresi', $_POST['ipadress']);
$update->bindValue(':ipusragent', "panel");
$update->bindValue(':ipsure', date('H:i:s'));
$update->execute();
if($update){
echo '<script>
alert("IP Eklendi");
window.location.replace("index.php?git=index")
</script>';
} else {
echo '<script>
alert("Kural Eklenemedi");
window.location.replace("index.php?git=index")
</script>';
}
break;

case 'methodekle':
session_start();
if (isset($_SESSION['girisyap'])){
	echo '
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.info/goruntu/153"></a>
  <div class="header-right">
    <a href="index.php?git=index">Ana Sayfa</a>
  </div>
</div>';
} else {	
	header('Location: index.php?git=login');
}
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
<form class="w3-container" action="index.php?git=methodpost" method="post">
<label>Method Adı</label>
<input type="text" name="methodadi" class="form-control" placeholder="Method Adı:"> 
<br>
<label>Method İçeriği (İzin Verilen</label>
<select class="form-control" name="methodicerik" id="methodicerik">
  <option value="GET">GET</option>
  <option value="POST">POST</option>
  <option value="PUT">PUT</option>
  <option value="DELETE">DELETE</option>
</select><br>
<input type="submit" value="Gönder" class="w3-button w3-red">
</form>';	
break;

case 'methodpost':
session_start();
if (isset($_SESSION['girisyap'])){
	echo '
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.biz/goruntu/153"></a>
  <div class="header-right">
    <a href="index.php?git=index">Ana Sayfa</a>
  </div>
</div>';
} else {
	header('Location: index.php?git=login');
}
$update = $db->prepare("INSERT INTO method_blok(method_adi, method_turu, method_bilgisi) VALUES (:methodadi, :methodicerik, :methodbilgi) ");
$update->bindValue(':methodadi', $_POST['methodadi']);
$update->bindValue(':methodbilgi', $_POST['methodadi']);
$update->bindValue(':methodicerik', $_POST['methodicerik']);
$update->execute();
if($update){
echo '<script>
alert("Kural Eklendi");
window.location.replace("index.php?git=index")
</script>';
} else {
echo '<script>
alert("Kural Eklenemedi");
window.location.replace("index.php?git=index")
</script>';
}
break;


case 'ipsil':
session_start();
if (isset($_SESSION['girisyap'])){
		echo '
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.info/goruntu/153"></a>
  <div class="header-right">
    <a href="index.php?git=uygulamayap">Ana Sayfa</a>
  </div>
</div>';
} else {	
	header('Location: index.php?git=login');
}
if(isset($_GET['ipsil'])){ 
$stmt = $db->prepare('DELETE FROM ip_ban WHERE ip_id = :postID') ;
$stmt->execute(array(':postID' => $_GET['ipsil']));
if($stmt){
echo '<script>
alert("IP Silindi");
window.location.replace("index.php?git=index")
</script>';
} else {
echo '<script>
alert("IP Silinemedi");
window.location.replace("index.php?git=index")</script>';
}
}
break;

case 'kuralsil':
session_start();
if (isset($_SESSION['girisyap'])){
		echo '
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.info/goruntu/153"></a>
  <div class="header-right">
    <a href="index.php?git=uygulamayap">Ana Sayfa</a>
  </div>
</div>';
} else {	
	header('Location: index.php?git=login');
}
if(isset($_GET['sil'])){ 
$stmt = $db->prepare('DELETE FROM guard_watch WHERE kural_id = :postID') ;
$stmt->execute(array(':postID' => $_GET['sil']));
if($stmt){
echo '<script>
alert("Kural Silindi");
window.location.replace("index.php?git=index")
</script>';
} else {
echo '<script>
alert("Kural Silinemedi");
window.location.replace("index.php?git=index")</script>';
}
}
break;

case 'methodsil':
session_start();
if (isset($_SESSION['girisyap'])){
		echo '
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="https://alicangonullu.info/goruntu/153"></a>
  <div class="header-right">
    <a href="index.php?git=uygulamayap">Ana Sayfa</a>
  </div>
</div>';
} else {	
	header('Location: index.php?git=login');
}
if(isset($_GET['sil'])){ 
$stmt = $db->prepare('DELETE FROM method_blok WHERE method_id = :postID') ;
$stmt->execute(array(':postID' => $_GET['sil']));
if($stmt){
echo '<script>
alert("Method Silindi");
window.location.replace("index.php?git=index")
</script>';
} else {
echo '<script>
alert("Method Silinemedi");
window.location.replace("index.php?git=index")</script>';
}
}
break;

case 'cikis':
session_start();
if (isset($_SESSION['girisyap'])){
} else {	
	header('Location: index.php?git=login');
}
session_start();
session_destroy();
session_unset();
echo (" Başarılı ");
header ("Location:index.php"); 
break;
}
?>
