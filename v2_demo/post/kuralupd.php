<?php
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
<center>No MySQL Connection</center>
<center>Bunun Sebebi Bir DDoS Saldırısı Olabilir</center>
<center>Sistem Yöneticinizle Irtibata Geçin</center>
	 </table>';
}
session_start();
if (isset($_SESSION['girisyap'])){
} else {	
	header('Location: ../index.php?git=login');
}
$update = $db->prepare("UPDATE guard_watch SET kural_adi = :kural_adi , kural_icerik = :kural_icerik WHERE kural_id = :gonderid ");
$update->bindValue(':gonderid', strip_tags($_GET['id']));
$update->bindValue(':kural_adi', strip_tags($_POST['kuraladi']));
$update->bindValue(':kural_icerik', strip_tags($_POST['kuralicerik']));
if($update){
echo '<script>
alert("Başarılı");
window.location.replace("../index.php?git=index")
</script>';
}
?>