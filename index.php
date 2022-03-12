<?php
include("class.aliwaf.php");
date_default_timezone_set('Europe/Istanbul');
$aliwafac = new AliWAF_Panel();
$aliwafac->GetirHead();
$aliwafac->KontrolDosya("yukle.lock");
$aliwafac->CSS();
$aliwafac->Guncelleme();


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
    <a class="active" href="index.php">Home</a>
    <a href="index.php?git=login">Login</a>
  </div>
</div><br>
<div style="padding-left:20px">
  <h1>pH Analyzer | AliWAF</h1>
  <p><a href="index.php?git=login">Click</a> for WAF Management.</p>
</div>
<hr></hr>
<div style="padding-left:20px">
  <h1>pH Analyzer Nedir ?</h1>
  <p>It is a program-based cybersecurity tool for companies and individuals. With this tool, it is aimed to search for vulnerabilities in codes and to reduce possible cyber security costs.</p>
</div>';
break;

case 'login':
echo '<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="logo.png"></a>
  <div class="header-right">
    <a href="index.php">Home</a>
    <a class="active" href="index.php?git=login">Login</a>
  </div>
</div><br>

<br>
<div class="simple-login-container">
<h2>pH Analyzer | AliWAF Login</h2><br>
<form action="index.php?git=loginkontrol" method="post">
<div class="row">
<div class="col-md-12 form-group">
<p>Username : <input data-role="input"  type="text" name="user" placeholder="Kullanıcı Adı"></p></div></div>
<div class="row">
<div class="col-md-12 form-group">
<p>Password : <input data-role="keypad"  type="password" name="pass" placeholder="Şifre"></p></div></div><br>
<div class="row">
<div class="col-md-12 form-group">
<img src="captcha.php"/>
<p>Captcha : <input data-role="keypad"  type="password" name="capt" placeholder="Captcha"></p></div></div><br>
<input type="hidden" name="csrf" value="'.$_SESSION["csrf"].'">
<p><div class="row">
<div class="col-md-12 form-group">
<button class="btn btn-block btn-login">Login</button></p></div><br>
</form>
</div>
<div class="col-md-12 form-group">
<a href="index.php?git=sifirla" class="btn btn-block btn-login">Reset Password</a></div>
</div>';
break;
 
case 'loginkontrol':
$aliwafac->DB_LoginCheck($_POST["user"], $_POST["pass"]);
break;

case 'index':
$aliwafac->KontrolSession();

echo '<div class="container">
<br><h3>WAF Status</h3>';

$js = json_decode($aliwafac->DB_GetirWAFStatus(), true);
foreach($js as $row) {
if($row['oto_ban'] == 1) {
echo '<div class="alert alert-success"><strong>Otomatik IP Ban : RUNNNING (1)</strong></div><br>';
} else {
echo '<div class="alert alert-danger"><strong>Otomatik IP Ban : NOT RUNNNING (0)</strong></div><br>';
}
if($row['waf_aktif'] == 1) {
echo '<div class="alert alert-success"><strong>WAF : RUNNNING (1)</strong></div><br>';
} else {
echo '<div class="alert alert-danger"><strong>WAF : NOT RUNNNING (0)</strong></div><br>';
}
if ($row['debug'] == 1){
echo '<td><div class="alert alert-success"><strong>DEBUG : RUNNNING</strong></div></td>';
} else {
echo '<td><div class="alert alert-danger"><strong>DEBUG : NOT RUNNNING</strong></div></td>';
}
if($row['ayar_aktif'] == 1) {
echo '<div class="alert alert-success"><strong>AYAR : RUNNNING (1)</strong></div><br>';
} else {
echo '<div class="alert alert-danger"><strong>AYAR : NOT RUNNNING (0)</strong></div><br>';
}	
}
echo '<div class="alert alert-success"><strong>IP Adresiniz : '.strip_tags($aliwafac->reel_ip()).'</strong></div><br>';
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
$js2 = json_decode($aliwafac->DB_GetirWAFRules(), true);
foreach($js2 as $row) {
echo '<tr>
<td><a class="button button3" href="javascript:kuralsil('.intval($row['kural_id']).')">Sil</a></td>
<td>'.strip_tags($row['kural_id']).'</td>
<td>'.strip_tags($row['kural_adi']).'</td>
<td><a href="index.php?git=kuralduzenle&id='.intval($row['kural_id']).'">Edit</a></td>
</tr>';
}
echo '</tbody></table></div>
<script language="JavaScript" type="text/javascript">
function kuralsil(id)
{
  if (confirm("Silmek istediğinize emin misiniz : " + id ))
  {
      window.location.href = "index.php?git=kuralsil&sil=" + id;
  }
}
</script>

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

$js3 = json_decode($aliwafac->DB_GetirWAFAllowedMethods(), true);
foreach($js3 as $row) {
echo '<tr>
<td><a class="button button3" href="javascript:delmethod('.intval($row['method_id']).')">Sil</a></td>
<td>'.strip_tags($row['method_id']).'</td>
<td>'.strip_tags($row['method_adi']).'</td>
<td>'.strip_tags($row['method_turu']).'</td>
<td><a href="index.php?git=methodduzenle&id='.strip_tags($row['method_id']).'">Edit</a></td>
</tr>';	
}
echo '</tbody></table></div>
<script language="JavaScript" type="text/javascript">
function delmethod(id)
{
  if (confirm("Silmek istediğinize emin misiniz : " + id ))
  {
      window.location.href = "index.php?git=methodsil&sil=" + id;
  }
}
</script>
<div class="container">
<table class="table">
<thead>
<br><h3>IP Address</h3>
<tr>
<th></th>
<th>ID</th>
<th>IP</th>
</tr></thead><tbody>';
$js4 = json_decode($aliwafac->DB_GetirIPBan(), true);
foreach($js4 as $row) {
echo '<tr>
<td><a class="button button3" href="javascript:delip('.intval($row['ip_id']).')">Sil</a></td>
<td>'.strip_tags($row['ip_id']).'</td>
<td>'.strip_tags($row['ip_adresi']).'</td>';
echo '
<td><a href="index.php?git=ipduzenle&id='.intval($row['ip_id']).'">Edit</a></td>
</tr>';	
}
echo '</tbody></table>
<br><br>
</div>
<script language="JavaScript" type="text/javascript">
function delip(id)
{
  if (confirm("Silmek istediğinize emin misiniz : " + id ))
  {
      window.location.href = "index.php?git=ipsil&ipsil=" + id;
  }
}
</script>';
break;

case 'loglar':
$aliwafac->KontrolSession();
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
$js5 = json_decode($aliwafac->DB_GetirLoglar(), true);
foreach($js5 as $row) {
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
$aliwafac->KontrolSession();

echo '<div class="container">
<table class="table">
<thead>
<br><h3>Admins</h3>
<tr>
<th>Admin ID</th>
<th>Admin Name</th>
</tr></thead><tbody>';

$js6 = json_decode($aliwafac->DB_GetirAdmin(), true);
foreach($js6 as $row) {
echo '<tr>
<td>'.strip_tags($row['id']).'</td>
<td>'.strip_tags($row['kadi']).'</td>
<td><a class="button" href="index.php?git=adminduzenle&id='.intval($row['id']).'">Edit</a>
</tr>';	
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

$js7 = json_decode($aliwafac->DB_GetirWAFStatus(), true);
foreach($js7 as $row) {
echo '<tr>
<td>'.intval($row['ayar_id']).'</td>';
$adminid = 1;
if ($row['waf_aktif'] == $adminid){
echo '<td><font color="green">Aktif</font></td>';
} else {
echo '<td><font color="red">Pasif</font></td>';
}
if ($row['oto_ban'] == $adminid){
echo '<td><font color="green">Aktif</font></td>';
} else {
echo '<td><font color="red">Pasif</font></td>';
}
if ($row['debug'] == $adminid){
echo '<td><font color="green">Aktif</font></td>';
} else {
echo '<td><font color="red">Pasif</font></td>';
}
echo '
<td>'.strip_tags($row['ayar_adi']).'</td>';

echo '<td><a class="button" href="index.php?git=ayarduzenle">Edit</a></tr>
</tbody></table></div>';	
}
break;

case 'sifirla':
	echo '
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="logo.png"></a>
  <div class="header-right">
    <a href="index.php?git=index">Ana Sayfa</a>
  </div>
</div>

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
<form class="w3-container container" action="index.php?git=sifirlandi" method="post">
<label>E-Mail</label>
<input type="text" name="email" data-role="input" placeholder="E-Mail:"> 
<br>
<label>Token</label>
<input type="password" name="token" data-role="input" placeholder="Token:"> <br>
<input type="submit" value="Gönder" class="w3-button w3-red">
</form>';
break;

case 'sifirlandi':
if($aliwafac->DB_SifirlaPassword() == true) {
echo '<meta name="viewport" content="width=device-width, initial-scale=1">
<div class="header">
  <a href="index.php" class="logo"><img class="logo" width="310" height="61" src="logo.png"></a>
  <div class="header-right">
    <a href="index.php?git=index">Ana Sayfa</a>
  </div>
</div>

<body class="w3-container">
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
break;

case 'ipduzenle':
$aliwafac->KontrolSession();
$js8 = json_decode($aliwafac->DB_GetirIPBilgi($_GET['id']), true);
foreach($js8 as $row) {
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
$aliwafac->KontrolSession();
$aliwafac->DB_InsertIP();
break;

case 'kuralduzenle':
$aliwafac->KontrolSession();
$js9 = json_decode($aliwafac->DB_GetirKural_ID(), true);
foreach($js9 as $row) {
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
$aliwafac->KontrolSession();
$js10 = json_decode($aliwafac->DB_GetirAdmin_ID(), true);
foreach($js10 as $row) {
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
<input type="number" name="pass" data-role="input" placeholder="Şifre:"> 
<br>
<label>E-Mail</label>
<input type="text" name="email" data-role="input" placeholder="E-Mail:" value="'.$row['email'].'">
<br>
<label>Token</label>
<input type="number" name="tokens" data-role="input" placeholder="Token:"> 
<br><br>
<input type="submit" value="Gönder" class="w3-button w3-red">
</form>';	
	}
break;

case 'kadiupd':
$aliwafac->KontrolSession();
$aliwafac->DB_InsertKullanici();
break;

case 'ayarduzenle':
$aliwafac->KontrolSession();

$js11 = json_decode($aliwafac->DB_GetirAyar_ID(), true);
foreach($js11 as $row) {
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
$aliwafac->KontrolSession();
$aliwafac->DB_UpdateAyar();
break;

case 'kuralekle':
$aliwafac->KontrolSession();
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
$aliwafac->KontrolSession();		
$aliwafac->DB_InsertRule();
break;

case 'kuralpost':
$aliwafac->KontrolSession();
$aliwafac->DB_UpdateKural();
break;

case 'methodduzenle':
$aliwafac->KontrolSession();

$js12 = json_decode($aliwafac->DB_DuzenleMethod_ID(), true);
foreach($js12 as $row) {
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
$aliwafac->KontrolSession();
$aliwafac->DB_GuncelleMethod_ID();
break;

case 'ipekle':
$aliwafac->KontrolSession();
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
$aliwafac->KontrolSession();
$aliwafac->DB_InsertIP_ID();
break;

case 'methodekle':
$aliwafac->KontrolSession();
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
$aliwafac->KontrolSession();
$aliwafac->DB_InsertMethod();
break;


case 'ipsil':
$aliwafac->KontrolSession();
$aliwafac->DB_DeleteIP();
break;

case 'kuralsil':
$aliwafac->KontrolSession();
$aliwafac->DB_DeleteRule();
break;

case 'methodsil':
$aliwafac->KontrolSession();
$aliwafac->DB_DeleteMethod();
break;

case 'update':
$aliwafac->KontrolSession();
$update = "http://alicangnll.github.io/aliwaf-phpwaf/";
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
$aliwafac->Exit();
break;
}
?>
