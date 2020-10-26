<?php
ob_start();
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
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
// IP Engelleme
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
<center><img src="veri/sql.png" alt="Örnek Resim"/></center>
<center>No MySQL Connection</center>
<center>Bunun Sebebi Bir DDoS Saldırısı Olabilir</center>
<center>Sistem Yöneticinizle Irtibata Geçin</center>
	 </table>';
	 die();
}

$adminid = md5(sha1(1));
try {

$stmt = $db->query("SELECT * FROM waf_ayar ORDER BY ayar_id");
if($stmt->rowCount()) {
while($row = $stmt->fetch()){
session_start();
$_SESSION['ayaraktif'] = md5(sha1($row["ayar_aktif"]));
$_SESSION['otoban'] = md5(sha1($row["oto_ban"]));
$_SESSION['ipadres'] = reel_ip();
$_SESSION['wafdurum'] = md5(sha1($row["waf_aktif"]));

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
session_start();
$_SESSION['suresi'] = strip_tags($row["ip_suresi"]);
	if ($_SESSION['wafdurum'] == $adminid){
		if ($_SESSION['suresi'] - date('H:i:s') >= 30){

		} else {
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
      Deneme Türü : IP Adresiniz Banlı (<?php echo strip_tags($ip); ?>)
    </div>
    <div class="hr"></div>
    <div class="context secondary-text-color">
	<p>IP Adresi : <?php echo strip_tags($ip); ?></p>
      <p>URL : <br><?php echo strip_tags($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']); ?></p>
	  <p>User-Agent : <br><?php echo strip_tags($_SERVER['HTTP_USER_AGENT']); ?></p>
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
					echo '
		<p align="center">IP Ban Listesindesiniz</p><br>
		<p align="center"> IP Adresin <b>'.strip_tags($ip).'</b>';
		die();
		}
	} else {
		header('X-AliWAF: DEACTIVE');
	}
   }
}
if ($_SESSION["ayaraktif"] == $adminid){

function kisalt($metin, $uzunluk){
$metin = substr($metin, 0, $uzunluk)."...";
$metin_son = strrchr($metin, " ");
$metin = str_replace($metin_son," ...", $metin);
return $metin;
}

$stmt = $db->query('SELECT * FROM guard_watch ORDER BY kural_id');
	while($row = $stmt->fetch()){
		$parametreler = strtolower($_SERVER['QUERY_STRING']);
		$yasaklar=($row['kural_icerik']);
		$yasakla=explode('¿¿',$yasaklar);
$sayiver=substr_count($yasaklar,'¿¿');
$i=0;
while ($i<=$sayiver) {
if (strstr($parametreler,$yasakla[$i])) {
if ($_SESSION['ayaraktif'] == $adminid){
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
      <p>URL : <br><?php echo strip_tags($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']); ?></p>
	  <p>User-Agent : <br><?php echo strip_tags($_SERVER['HTTP_USER_AGENT']); ?></p>
	  <p>Tarih : <?php echo strip_tags(date('d.m.Y H:i:s')); ?></p>
    </div>
    <div class="buttons-container">
      <a class="button" onclick="history.back();" target="_blank"><span class="fa fa-home"></span> Geri Dön</a>
      <a class="button" href="mailto:alicangonullu@yahoo.com" target="_blank"><span class="fa fa-warning"></span> Problem Bildir</a>
    </div>
	<?php
if ($_SESSION['otoban'] == $adminid){
$bandurum = md5(sha1(1));
$update = $db->prepare("INSERT INTO ip_ban(ip_adresi, ip_suresi) VALUES (:ipadresi, :ipsuresi) ");
$update->bindValue(':ipadresi', strip_tags($ip));
$update->bindValue(':ipsuresi', date('H:i:s'));
$update->execute();
if($update){

echo ' <div class="context secondary-text-color">
<p>IP Adresiniz 1 Saat Banlandı.</p>
</div>';
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
$method = strip_tags($_SERVER['REQUEST_METHOD']);
$stmt = $db->query("SELECT * FROM method_blok WHERE method_turu = '$method'");
if($stmt->rowCount()) {
while($row = $stmt->fetch()){
   }
		} else
	{

if ($_SESSION['ayaraktif'] == $adminid){
header($_SERVER["SERVER_PROTOCOL"]." 405 Method Not Allowed", true, 405);
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
      Deneme Türü : Method Injection (<?php echo $method ?>)
    </div>
    <div class="hr"></div>
    <div class="context secondary-text-color">
	<p> Method Türü : <?php echo strip_tags($method); ?></p>
      <p>URL : <br><?php echo strip_tags($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']); ?></p>
	  <p>User-Agent : <br><?php echo strip_tags($_SERVER['HTTP_USER_AGENT']); ?></p>
	  <p>Tarih : <?php echo date('d.m.Y H:i:s'); ?></p>
    </div>
    <div class="buttons-container">
      <a class="button" onclick="history.back();" target="_blank"><span class="fa fa-home"></span> Geri Dön</a>
      <a class="button" href="mailto:alicangonullu@yahoo.com" target="_blank"><span class="fa fa-warning"></span> Problem Bildir</a>
    </div>
	<?php
if ($_SESSION['otoban'] == $adminid){
$bandurum = md5(sha1(1));
$update = $db->prepare("INSERT INTO ip_ban(ip_adresi, ip_suresi) VALUES (:ipadresi, :ipsuresi) ");
$update->bindValue(':ipadresi', strip_tags($ip));
$update->bindValue(':ipsuresi', date('H:i:s'));
$update->execute();
if($update){
echo ' <div class="context secondary-text-color">
<p>IP Adresiniz 1 Saat Banlandı.</p>
</div>';
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