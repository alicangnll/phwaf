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
	if(isset($_GET['ipsil'])){ 

    $stmt = $db->prepare('DELETE FROM ip_ban WHERE ip_id = :postID') ;
    $stmt->execute(array(':postID' => $_GET['ipsil']));
	if($stmt){
echo '<script>
alert("IP Silindi");
window.location.replace("../ytk_kontrol.php?git=anasayfa")
</script>';
} else {
	echo '<script>
	alert("IP Silinemedi");
	window.location.replace("../ytk_kontrol.php?git=anasayfa")</script>';
}
}
	?>