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
	$update = $db->prepare("INSERT INTO method_blok(method_adi, method_bilgisi, method_turu) VALUES (:methodadi, :methodhk, :methodno) ");
	$update->bindValue(':methodadi', $_POST['method_adi']);
	$update->bindValue(':methodhk', $_POST['method_bilgisi']);
	$update->bindValue(':methodno', $_POST['method_turu']);
//Post Empty
	$update->execute();
	if($update){
echo '<script>
alert("Method Eklendi");
window.location.replace("../ytk_kontrol.php?git=anasayfa")
</script>';
}
    ?>
