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
	if(isset($_GET['admsil'])){ 

    $stmt = $db->prepare('DELETE FROM admin_giris WHERE admin_id = :postID') ;
    $stmt->execute(array(':postID' => $_GET['admsil']));
	if($stmt){
echo '<script>
alert("Admin Silindi");
window.location.replace("../ytk_kontrol.php?git=anasayfa")
</script>';
} else {
	echo '<script>
	alert("Admin Silinemedi");
	window.location.replace("../ytk_kontrol.php?git=anasayfa")</script>';
}
}
	?>