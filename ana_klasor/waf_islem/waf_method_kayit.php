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
  <a align="right" href="ytk_kontrol.php?git=ipekle">IP Ekle</a>
  <a align="right" href="ytk_kontrol.php?git=adminekle">Admin Ekle</a>
  <a align="right" href="ytk_kontrol.php?git=portekle">Port Ekle</a>
  <a align="right" href="ytk_kontrol.php?git=cmdmanage">Komut Yöneticisi</a>
  <a align="right" href="ytk_kontrol.php?git=servercheck">Server Sağlığı</a>
  <a align="right" href="ytk_kontrol.php?git=cikis">Çıkış</a>
	<?php
	echo '</div>';
    }
	else {
        header('Location: ../ytk_kontrol.php?git=anasayfa');  
    }													
	$update = $db->prepare("INSERT INTO method_blok(method_adi, method_bilgisi, method_turu) VALUES (:portadı, :porthk, :portno) ");
	$update->bindValue(':portadı', $_POST['method_adi']);
	$update->bindValue(':porthk', $_POST['method_bilgisi']);
	$update->bindValue(':portno', $_POST['method_turu']);
//Post Empty
	$update->execute();
	if($update){
echo '<script>
alert("Method Eklendi");
window.location.replace("../ytk_kontrol.php?git=anasayfa")
</script>';
}
    ?>
