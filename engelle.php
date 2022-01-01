<?php
include("class.engelle.php");
$stmt = $aliwaf->query("SELECT * FROM waf_ayar ORDER BY ayar_id");
if($stmt->rowCount()) {
while($row = $stmt->fetch()){
session_start();
$ayaraktif = md5(sha1($row["ayar_aktif"]));
$otoban = md5(sha1($row["oto_ban"]));
$ipadres = reel_ip();
$wafdurum = md5(sha1($row["waf_aktif"]));
$debug = md5(sha1($row["debug"]));
if (md5(sha1($row["ayar_aktif"])) == md5(sha1(1))){
header('X-AliWAF: ACTIVE');
} else {
header('X-AliWAF: DEACTIVE');
}
   }
		}

if ($wafdurum == md5(sha1(1))){
if ($debug == md5(sha1(1))){
Debug();
} else {
}
memlimit("256", "MB");
if ($ayaraktif == md5(sha1(1))){
$ip = reel_ip();
$stmt = $aliwaf->prepare("SELECT * FROM ip_ban WHERE ip_adresi = :ip");
$stmt->bindValue(":ip", $ip, PDO::PARAM_INT);
$stmt->execute();
if($stmt->fetchColumn()) {
while($row = $stmt->fetch()){
session_start();
$suresi = strip_tags($row["ip_suresi"]);
$ipusragent = strip_tags($row["ip_usragent"]);

if($ipusragent == "panel") {
ErrorMessage("IP Ban | Unlimited", strip_tags($ip));
} else {
if ($suresi - date('H:i:s') >= 30){
} else {
ErrorMessage("IP Ban", strip_tags($ip));
die();
		}
}

}
}

if($_POST) {
$stmt = $aliwaf->query('SELECT * FROM guard_watch ORDER BY kural_id');
while($row = $stmt->fetch()){
$parametreler = strtolower(urldecode(file_get_contents('php://input')));
$parametreler0 = str_replace("#", "", $parametreler);
$parametreler1 = str_replace("!", "", $parametreler0);
$parametreler2 = str_replace("=", "", $parametreler1);
$parametreler8 = str_replace("&", "", $parametreler2);
$yasaklar=$row['kural_icerik'];
$yasakla=explode('¿¿',$yasaklar);
$sayiver=substr_count($yasaklar,'¿¿');
$i=0;
while ($i<=$sayiver) {
if (strstr($parametreler8,$yasakla[$i])) {
ErrorMessage("POST Injection", strip_tags("Type : ".kisalt($parametreler8, 50)." | ".$row['kural_adi'].""));

if ($otoban == md5(sha1(1))){
$bandurum = md5(sha1(1));
$update = $aliwaf->prepare("INSERT INTO ip_ban(ip_adresi, ip_suresi, ip_usragent) VALUES (:ipadresi, :ipsuresi, :ipusragent) ");
$update->bindValue(':ipadresi', strip_tags(reel_ip()));
$update->bindValue(':ipusragent', strip_tags($_SERVER['HTTP_USER_AGENT']));
$update->bindValue(':ipsuresi', date('H:i:s'));
$update->execute();
if($update){
IPError("1");
die();
}
} else {
die();
}

}
$i++;
}
	}
} else {
$stmt = $aliwaf->query('SELECT * FROM guard_watch ORDER BY kural_id');
while($row = $stmt->fetch()){
$parametreler = strtolower($_SERVER['QUERY_STRING']);
$parametreler0 = str_replace("#", "", $parametreler);
$parametreler1 = str_replace("!", "", $parametreler0);
$parametreler2 = str_replace("=", "", $parametreler1);
$parametreler8 = str_replace("&", "", $parametreler2);
$yasaklar=($row['kural_icerik']);
$yasakla=explode('¿¿',$yasaklar);
$sayiver=substr_count($yasaklar,'¿¿');
$i=0;
while ($i<=$sayiver) {
if (strstr($parametreler8,$yasakla[$i])) {
ErrorMessage("Rule Injection", strip_tags($row['kural_adi']));

if ($otoban == md5(sha1(1))){
$bandurum = md5(sha1(1));
$update = $aliwaf->prepare("INSERT INTO ip_ban(ip_adresi, ip_suresi, ip_usragent) VALUES (:ipadresi, :ipsuresi, :ipusragent) ");
$update->bindValue(':ipadresi', strip_tags($ip));
$update->bindValue(':ipusragent', strip_tags($_SERVER['HTTP_USER_AGENT']));
$update->bindValue(':ipsuresi', date('H:i:s'));
$update->execute();
if($update){
IPError("1");
die();
}
} else {
die();
}
}
$i++;
}
if (strlen($parametreler8)>=90) {
exit;
}
}
	//Guard Bitti
}
$method = strip_tags($_SERVER['REQUEST_METHOD']);
$stmt = $aliwaf->query("SELECT * FROM method_blok WHERE method_turu = :method");
$stmt->bindValue(":method", $method, PDO::PARAM_INT);
$stmt->execute();
if($stmt->fetchColumn()) {
while($row = $stmt->fetch()){
   }
} else {
header($_SERVER["SERVER_PROTOCOL"]." 405 Method Not Allowed", true, 405);
ErrorMessage("Method Injection", strip_tags($method));
if ($otoban == md5(sha1(1))){
$bandurum = md5(sha1(1));
$update = $aliwaf->prepare("INSERT INTO ip_ban(ip_adresi, ip_suresi, ip_usragent) VALUES (:ipadresi, :ipsuresi, :ipusragent) ");
$update->bindValue(':ipadresi', strip_tags($ip));
$update->bindValue(':ipusragent', strip_tags($_SERVER['HTTP_USER_AGENT']));
$update->bindValue(':ipsuresi', date('H:i:s'));
$update->execute();
if($update){
IPError("1");
die();
}
} else {

}

}
} else {
header('X-AliWAF: CONFIG-DEACTIVE');
}
} else {
header('X-AliWAF: DEACTIVE');
}
	//Istek Engellendi

?>
