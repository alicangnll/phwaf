<?php 
require_once("../../baglanti.php");
require_once("../../ozel_fonksiyon.php");
echo '<meta name="robots" content="noarchive, noindex" />';
    session_start();
    if (isset($_SESSION['oturum'])){
    }
	else {
        header('Location: ../ytk_kontrol.php?git=anasayfa');  
    }
	if(isset($_GET['methodsil'])){ 

    $stmt = $db->prepare('DELETE FROM method_blok WHERE method_id = :postID') ;
    $stmt->execute(array(':postID' => $_GET['methodsil']));
	if($stmt){
echo '<script>
alert("Method Silindi");
window.location.replace("../ytk_kontrol.php?git=anasayfa")
</script>';
} else {
	echo '<script>
	alert("Method Silinemedi");
	window.location.replace("../ytk_kontrol.php?git=anasayfa")</script>';
}
}
	?>