<?php
header("X-XSS-Protection: 1; mode=block");
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
include("baglanti.php");

if(!isset($_GET['y'])) {
$sayfa = 'index.php';	// eğer boşsa anasayfa varsayalım.
} else {
   $sayfa = $_GET['y'];
}
 
switch($sayfa) {
 
   case 'kontrol':
   $name = $_POST["kadi"];
   $pass = sha1(md5($_POST['sifre']));
$query  = $db->query("SELECT * FROM admin_giris WHERE user_name =" . $db->quote($name) . " && pass_word=" . $db->quote($pass) . "",PDO::FETCH_ASSOC);
		if ( $say = $query -> rowCount() ){
			if( $say > 0 ){
				session_start();
				session_regenerate_id();
				$_SESSION['oturum'] = time() + 1800;
				$_SESSION['kullanici_adi']= $name;
				$_SESSION['oturum']=true;
				header('Location: ./ana_klasor/ytk_kontrol.php');
			}
		}else{
			echo '<meta name="viewport" content="width=device-width, initial-scale=1">
                              <p>HATA: Oturum Açılamadı!</p>';
			die();
		}
   break;
   
		//Eğer Girmezse
   default:
   echo '
   <title>Bulunamadı!</title>
   <h2>Bulunamadı!</h2>
   <p>Böyle bir sayfamız henüz yok, değiştirilmiş ya da silinmiş olabilir.</p>'; // hiç birisi değilse 404 varsayalim
}
?>