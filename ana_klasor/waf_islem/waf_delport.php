<?php 
require_once("../../baglanti.php");
require_once("../../ozel_fonksiyon.php");
echo '<meta name="robots" content="noarchive, noindex" />';
    session_start();
    if (isset($_SESSION['oturum'])){
		echo '<div class="topnav">'
	echo '</div>';
    }
	else {
        header('Location: ../ytk_kontrol.php?git=anasayfa');  
    }
	if(isset($_GET['portsil'])){ 

    $stmt = $db->prepare('DELETE FROM port_blok WHERE port_id = :postID') ;
    $stmt->execute(array(':postID' => $_GET['portsil']));
	if($stmt){
echo '<script>
alert("Port Silindi");
window.location.replace("../ytk_kontrol.php?git=anasayfa")
</script>';
} else {
	echo '<script>
	alert("Port Silinemedi");
	window.location.replace("../ytk_kontrol.php?git=anasayfa")</script>';
}
}
	?>