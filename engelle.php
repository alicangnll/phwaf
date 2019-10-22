<?php
include("libs/libs.php");
// IP Engelleme

$adminid = md5(sha1(1));
try {
$stmt = $db->query("SELECT * FROM waf_ayar ORDER BY ayar_id");
if($stmt->rowCount()) {
while($row = $stmt->fetch()){
	
$ayaraktif = md5(sha1($row["ayar_aktif"]));
$otoban = md5(sha1($row["oto_ban"]));
$ipadres = reel_ip();
$wafdurum = md5(sha1($row["waf_aktif"]));

if (md5(sha1($row["ayar_aktif"])) == $adminid){
header('X-AliWAF: ACTIVE');
} else {
header('X-AliWAF: DEACTIVE');
}	
   }
		}
		    } catch(PDOException $e) {
}
$ip = reel_ip();
$stmt = $db->query("SELECT * FROM ip_ban WHERE ip_adresi = '$ip'");
if($stmt->rowCount()) {
while($row = $stmt->fetch()){
$suresi = $row["ip_suresi"];
	if ($wafdurum == $adminid){
		if ($suresi - date('H:i:s') >= 30){
			
		} else {
style();
?>
  
  <body class="background error-page-wrapper background-color background-image">
    <center>
  <div class="content-container shadow">
  <br>
    <div class="head-line secondary-text-color">
		Illegal Girişim Algılandı | IP Ban
    </div>
	<div class="hr"></div>
    <div class="context primary-text-color">
      Deneme Türü : IP Adresiniz Banlı (<?php echo $ip ?>)
    </div>
    <div class="hr"></div>
    <div class="context secondary-text-color">
	<p>IP Adresi : <?php echo $ip ?></p>
      <p>URL : <br><?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?></p>
	  <p>User-Agent : <br><?php echo $_SERVER['HTTP_USER_AGENT']; ?></p>
	  <p>Tarih : <?php echo date('d.m.Y H:i:s'); ?></p>
    </div>
    <div class="buttons-container">
      <a class="button" onclick="history.back();" target="_blank"><span class="fa fa-home"></span> Geri Dön</a>
      <a class="button" href="mailto:alicangonullu@yahoo.com" target="_blank"><span class="fa fa-warning"></span> Problem Bildir</a>
    </div>
  </div>
</center>   
</body>
<?php
IPError("1");
		die();
		}
	} else {
		header('X-AliWAF: DEACTIVE');
	}		
   }
}
if ($ayaraktif == $adminid){

$stmt = $db->query('SELECT * FROM guard_watch ORDER BY kural_id');
	while($row = $stmt->fetch()){
		$parametreler = strtolower($_SERVER['QUERY_STRING']); 
		$yasaklar=($row['kural_icerik']);
		$yasakla=explode('¿¿',$yasaklar);
$sayiver=substr_count($yasaklar,'¿¿');
$i=0;
while ($i<=$sayiver) {
if (strstr($parametreler,$yasakla[$i])) {
if ($ayaraktif == $adminid){
	style();
?>
  <body class="background error-page-wrapper background-color background-image">
    <center>
  <div class="content-container shadow">
  <br>
    <div class="head-line secondary-text-color">
		Illegal Girişim Algılandı
    </div>
	<div class="hr"></div>
    <div class="context primary-text-color">
      Deneme Türü : <?php echo $row['kural_adi']; ?>
    </div>
    <div class="hr"></div>
    <div class="context secondary-text-color">
      <p>URL : <br><?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?></p>
	  <p>User-Agent : <br><?php echo $_SERVER['HTTP_USER_AGENT']; ?></p>
	  <p>Tarih : <?php echo date('d.m.Y H:i:s'); ?></p>
    </div>
    <div class="buttons-container">
      <a class="button" onclick="history.back();" target="_blank"><span class="fa fa-home"></span> Geri Dön</a>
      <a class="button" href="mailto:alicangonullu@yahoo.com" target="_blank"><span class="fa fa-warning"></span> Problem Bildir</a>
    </div>
	<?php
if ($otoban == $adminid){
$json = json_encode(apache_request_headers());
$bandurum = md5(sha1(1));
$update = $db->prepare("INSERT INTO ip_ban(ip_adresi, ip_suresi, ip_usragent) VALUES (:ipadresi, :ipsuresi, :ipusr) ");
$update->bindValue(':ipadresi', strip_tags($ip));
$update->bindValue(':ipsuresi', date('H:i:s'));
$update->bindValue(':ipusr', strip_tags($json));
$update->execute();
if($update){
IPError("1");
die();
}
} else {
die();
}
?>
  </div>
</center>   
</body>
<?php
} else {
header('X-AliWAF: DEACTIVE');
}
}
 
$i++;	
}
if (strlen($parametreler)>=90) {
exit;	
}
	}
	//Guard Bitti
$method = $_SERVER['REQUEST_METHOD'];
$stmt = $db->query("SELECT * FROM method_blok WHERE method_turu = '$method'");
if($stmt->rowCount()) {
while($row = $stmt->fetch()){
   }
		} else
	{

if ($ayaraktif == $adminid){
header($_SERVER["SERVER_PROTOCOL"]." 405 Method Not Allowed", true, 405);
?>
</head>
  <body class="background error-page-wrapper background-color background-image">
    <center>
  <div class="content-container shadow">
  <br>
    <div class="head-line secondary-text-color">
		Illegal Girişim Algılandı
    </div>
	<div class="hr"></div>
    <div class="context primary-text-color">
      Deneme Türü : Method Injection (<?php echo $method ?>)
    </div>
    <div class="hr"></div>
    <div class="context secondary-text-color">
	<p> Method Türü : <?php echo $method ?></p>
      <p>URL : <br><?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?></p>
	  <p>User-Agent : <br><?php echo $_SERVER['HTTP_USER_AGENT']; ?></p>
	  <p>Tarih : <?php echo date('d.m.Y H:i:s'); ?></p>
    </div>
    <div class="buttons-container">
      <a class="button" onclick="history.back();" target="_blank"><span class="fa fa-home"></span> Geri Dön</a>
      <a class="button" href="mailto:alicangonullu@yahoo.com" target="_blank"><span class="fa fa-warning"></span> Problem Bildir</a>
    </div>
	<?php
$json = json_encode(apache_request_headers());
if ($otoban == $adminid){
$bandurum = md5(sha1(1));
$update = $db->prepare("INSERT INTO ip_ban(ip_adresi, ip_suresi, ip_usragent) VALUES (:ipadresi, :ipsuresi, :ipusr) ");
$update->bindValue(':ipadresi', strip_tags($ip));
$update->bindValue(':ipsuresi', date('H:i:s'));
$update->bindValue(':ipusr', strip_tags($json));
$update->execute();
if($update){
die();
}
} else {
	die();
}
?>
  </div>
</center>   
</body>
<?php

} else {
header('X-AliWAF: DEACTIVE');
		}			
	}

} else {
	header('X-AliWAF: PENDING');
}
	//Istek Engellendi

?>