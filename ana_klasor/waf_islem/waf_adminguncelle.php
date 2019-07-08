<?php 
require_once("../../baglanti.php");
require_once("../../ozel_fonksiyon.php");
echo '<meta name="robots" content="noarchive, noindex" />';
    session_start();
    if (isset($_SESSION['oturum'])){
		echo '<div class="topnav">'
	?>
  <a href="ytk_kontrol.php">Ana Sayfa</a>
  <a align="right" href="ytk_kontrol.php?git=kuralekle">Kural Ekle</a>
  <a align="right" href="ytk_kontrol.php?git=cikis">Çıkış</a>
	<?php
	echo '</div>';
    }
	else {
        header('Location: ../ytk_kontrol.php?git=anasayfa'); 
    }
	?>
	<?php
	$update = $db->prepare("UPDATE admin_giris SET user_name = :usrname , pass_word = :psword WHERE admin_id = :gonderid ");
	$update->bindValue(':gonderid', $_POST['gonderid']);
	$update->bindValue(':usrname', $_POST['kadi']);
	$update->bindValue(':psword', sha1(md5($_POST['sifre'])));
	$update->execute();
	if($update){
echo '<script>
alert("Kural Güncellendi");
window.location.replace("../ytk_kontrol.php?git=anasayfa")
</script>';
}?>