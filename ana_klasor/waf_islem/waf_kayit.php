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
	$update = $db->prepare("INSERT INTO guard_watch(kural_adi, kural_hakkinda, kural_icerik) VALUES (:kuraladi, :kuralhakkinda, :kuralicerik) ");
	$update->bindValue(':kuraladi', $_POST['kuraladi']);
	$update->bindValue(':kuralhakkinda', $_POST['kuralhakkinda']);
	$update->bindValue(':kuralicerik', $_POST['kuralicerik']);
//Post Empty
	$update->execute();
	if($update){
echo '<script>
alert("Kural Güncellendi");
window.location.replace("../ytk_kontrol.php?git=anasayfa")
</script>';
}
    ?>
