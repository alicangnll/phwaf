<?php
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
}

$adminid = 1;
try {
$stmt = $db->query("SELECT * FROM waf_ayar ORDER BY ayar_id");
if($stmt->rowCount()) {
while($row = $stmt->fetch()){
setcookie("ayaraktif", $row["ayar_aktif"]);
setcookie("otoban", $row["oto_ban"]);
setcookie("ipadres", reel_ip());
setcookie("wafdurum", $row["waf_aktif"]);
if ($_COOKIE["wafdurum"] == $adminid){
header('X-AliWAF: ACTIVE');
echo '<script>console.log("WAF : ON! | Koruma Prosedurleri Calisiyor");</script>';
} else {
header('X-AliWAF: DEACTIVE');
echo '<script>console.log("WAF : OFF!");</script>';
}	
   }
		}
if ($_COOKIE["ayaraktif"] == $adminid){
	// IP Engelleme Bitti
if ($_COOKIE["otoban"] == 1){
if ($_COOKIE["banned"] == 1){
	echo 'IP Ban Listesindesiniz (1 (Bir) Saat)<br>IP Adresiniz
	'.$_COOKIE["ipadres"].'';
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
	if ($_COOKIE["wafdurum"] == $adminid){
		echo '
		<p align="center">IP Ban Listesindesiniz</p><br>
		<p align="center"> IP Adresin <b>'.$ip.'</b>';
	die();
	} else {
		header('X-AliWAF: DEACTIVE');
echo '<script>console.log("WAF : OFF!");</script>';
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
if ($_COOKIE["wafdurum"] == $adminid){
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
if ($_COOKIE["otoban"] == $adminid){
$bandurum = 1;
setcookie("banned", $bandurum ,time()+3600);
echo '<p>IP Ban Yediniz! (1 (Bir) Saat)</p>';
die();
} else {
setcookie("nonbanned", 0);
}
exit;
} else {
	header('X-AliWAF: DEACTIVE');
echo '<script>console.log("WAF : OFF!");</script>';
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
		if ($_COOKIE["wafdurum"] == $adminid){
	echo '<script>console.log("WAF : ON! | Sızma Prosedurleri Calisiyor");</script>';
			header($_SERVER["SERVER_PROTOCOL"]." 405 Method Not Allowed", true, 405);
				echo '
		<p align="center">Method Serverda Engellendi</p><br>
		<p align="center"> Method Türü <b>'.$method.'</b>';
	die();
		} else {
header('X-AliWAF: DEACTIVE');
echo '<script>console.log("WAF : OFF!");</script>';
		}			
	}
} else {
	header('X-AliWAF: PENDING');
echo '<script>console.log("WAF : AYAR BEKLIYOR!");</script>';
}
	//Istek Engellendi
    } catch(PDOException $e) {
}
?>