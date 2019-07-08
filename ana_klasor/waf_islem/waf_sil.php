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
	if(isset($_GET['kuralsil'])){ 

    $stmt = $db->prepare('DELETE FROM guard_watch WHERE kural_id = :postID') ;
    $stmt->execute(array(':postID' => $_GET['kuralsil']));
	if($stmt){
echo '<script>
alert("Kural Silindi");
window.location.replace("../ytk_kontrol.php?git=anasayfa")
</script>';
} else {
	echo '<script>
	alert("Kural Silinemedi");
	window.location.replace("../ytk_kontrol.php?git=anasayfa")</script>';
}
}
	?>