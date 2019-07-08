<?php 
require_once("../../baglanti.php");
require_once("../../ozel_fonksiyon.php");
echo '<meta name="robots" content="noarchive, noindex" />';
    session_start();
    if (isset($_SESSION['oturum'])){
		echo '<div class="topnav">'
	?>
	<?php
	echo '</div>';
    }
	else {
        header('Location: ../ytk_kontrol.php?git=anasayfa');  
    }
	?>
	<?php 														
	$update = $db->prepare("INSERT INTO admin_giris(user_name, pass_word) VALUES (:username, :password) ");
	$update->bindValue(':username', $_POST['kadi']);
	$update->bindValue(':password', sha1(md5($_POST['sifre'])));
	$update->execute();
	if($update){
echo '<script>
alert("Kural Güncellendi");
window.location.replace("../ytk_kontrol.php?git=anasayfa")
</script>';
}
    ?>
