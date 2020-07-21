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
$antiddos = md5(sha1($row["anti_ddos"]));
$debug = md5(sha1($row["debug"]));
$request = time();
if (md5(sha1($row["ayar_aktif"])) == $adminid){
header('X-AliWAF: ACTIVE');
DoSDenetleme("50");
} else {
header('X-AliWAF: DEACTIVE');
}	
   }
		}
		    } catch(PDOException $e) {
}
memlimit("256", "MB");
$ip = reel_ip();
if ($ayaraktif == $adminid){
if ($antiddos == $adminid){
// Soon
} else {
}

if ($debug == $adminid){
Debug();
} else {
}
$stmt = $db->query("SELECT * FROM ip_ban WHERE ip_adresi = ".$db->quote(strip_tags($ip))."");
if($stmt->rowCount()) {
while($row = $stmt->fetch()){
$suresi = $row["ip_suresi"];
	if ($wafdurum == $adminid){
		if ($suresi - date('H:i:s') >= 30){
			
		} else {
style();
Error($ip, $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'], $_SERVER['HTTP_USER_AGENT'], date('d.m.Y H:i:s'), "IP Ban");
		die();
		}
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
if ($ayaraktif == $adminid){

style();
Error($ip, $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'], $_SERVER['HTTP_USER_AGENT'], date('d.m.Y H:i:s'), $row['kural_adi']);

if ($otoban == $adminid){
$json = json_encode(apache_request_headers());
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
 
$i++;	
}
if (strlen($parametreler)>=90) {
exit;	
}
	}
	//Guard Bitti
$method = $_SERVER['REQUEST_METHOD'];
$stmt = $db->query("SELECT * FROM method_blok WHERE method_turu = ".$db->quote(strip_tags($method))."");
if($stmt->rowCount()) {
while($row = $stmt->fetch()){
   }
		} else
	{

if ($ayaraktif == $adminid){
header($_SERVER["SERVER_PROTOCOL"]." 405 Method Not Allowed", true, 405);
style();
Error($method, $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'], $_SERVER['HTTP_USER_AGENT'], date('d.m.Y H:i:s'), "Illegal Method");
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
