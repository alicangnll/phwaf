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
	$update = $db->prepare("UPDATE guard_watch SET kural_adi = :kuraladi2 , kural_hakkinda = :kuralhakkinda2 , kural_icerik = :kuralicerik2 WHERE kural_id = :gonderid ");
	$update->bindValue(':gonderid', $_POST['gonderid']);
	$update->bindValue(':kuraladi2', $_POST['kuraladi2']);
	$update->bindValue(':kuralhakkinda2', $_POST['kuralhakkinda2']);
	$update->bindValue(':kuralicerik2', $_POST['kuralicerik2']);
	$update->execute();
	if($update){
echo '<script>
alert("Kural Güncellendi");
window.location.replace("../ytk_kontrol.php?git=anasayfa")
</script>';
}?>