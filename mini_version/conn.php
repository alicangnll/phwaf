<?php
try {
$ip = "localhost"; //host
$user = "root";  // host id
$password = "";  // password local olduğu için varsayılan şifre
$dbad = "ali_waf"; // db adı
	
     $db = new PDO("mysql:host=$ip;dbname=$dbad", "$user", "$password");
     $db->query("SET CHARACTER SET utf8");
     $db->query("SET NAMES utf8");

} catch ( PDOException $e ){
die("<table>
<center>No MySQL Connection</br>
Bunun Sebebi Bir DDoS Saldırısı Olabilir</br>
Sistem Yöneticinizle Irtibata Geçin</br>
<a href=install.php>Yükle / Install</a></center>
</table>");
}
?>