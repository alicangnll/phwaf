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
error_reporting(0);
try {
	$ip = "localhost"; //host
	$user = "root";  // host id
	$password = "";  // password local olduğu için varsayılan şifre
	$dbad = "ali_waf"; // db adı 
	
     $db = new PDO("mysql:host=$ip;dbname=$dbad", "$user", "$password");
     $db->query("SET CHARACTER SET 'utf8'");
     $db->query("SET NAMES 'utf8'");

} catch ( PDOException $e ){
     echo '
	 <table>
<center><img src="./veri/img/sql.png" alt="Örnek Resim"/></center>
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

if ($_SESSION['ayaraktif'] == $adminid){
header('X-AliWAF: ACTIVE');
} else {
header('X-AliWAF: DEACTIVE');
}	
   }
		}
if ($_SESSION["ayaraktif"] == $adminid){
	// IP Engelleme Bitti
if ($_SESSION['otoban'] == md5(sha1(1))){
if ($_SESSION["banned"] == md5(sha1(1))){
	echo '<center>IP Ban Listesindesiniz (1 (Bir) Saat)<br>IP Adresiniz'.$_SESSION['ipadres'].'</center>';
	die();
} else {
	//No
}
} else {
	//No
}
	//Guard Izleme
$ip = reel_ip();
$stmt = $db->query("SELECT * FROM ip_ban WHERE ip_adresi = '$ip'");
if($stmt->rowCount()) {
while($row = $stmt->fetch()){
	if ($_SESSION["wafdurum"] == $adminid){
		echo '
		<p align="center">IP Ban Listesindesiniz</p><br>
		<p align="center"> IP Adresin <b>'.$ip.'</b>';
	die();
	} else {
		header('X-AliWAF: DEACTIVE');
	}		
   }
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
	echo '<script>console.log("WAF : ON! | Sızma Prosedurleri Calisiyor");</script>';
    echo '<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>pH Analyzer - Yasaklı Komut Algılandı</title>
	</head>
	<center><body>pH Analyzer - Yasaklı Komut Algılandı.</body></center>
	<hr></hr>
	<center><body><p>Komut Tipi : <h3>'.$row['kural_adi'].'</h3></p></body>
	<a href="javascript:history.back()">
Return to previous page ( Geri Dön )
</a></center>';
if ($_SESSION['otoban'] == $adminid){
$bandurum = md5(sha1(1));

session_start();
$_SESSION['banned'] = md5(sha1($bandurum));
echo '<p>IP Ban Yediniz! (1 (Bir) Saat)</p>';
die();
} else {
setcookie("nonbanned", 0);
}
exit;
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

if ($_SESSION['ayaraktif'] == $adminid){
header($_SERVER["SERVER_PROTOCOL"]." 405 Method Not Allowed", true, 405);
echo '<p align="center">Method Serverda Engellendi</p><br>
<p align="center"> Method Türü <b>'.$method.'</b>';
die();
} else {
header('X-AliWAF: DEACTIVE');
		}			
	}
} else {
	header('X-AliWAF: PENDING');
}
	//Istek Engellendi
    } catch(PDOException $e) {
}
?>