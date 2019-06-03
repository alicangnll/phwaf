<?php include("../yetki_kontrol.php");
	$update = $db->prepare("INSERT INTO kadi_giris SET kadi = :kadi , ksifre = :ksifre ");
	
	$update->bindValue(':ksifre', sha1(md5($_POST['ksifre'])));
	$update->bindValue(':kadi', htmlspecialchars($_POST['kadi']));
	$update->execute();
	if(empty($update)){
echo '<script>
alert("Kullanıcı Kaydı Başarısız");
window.location.replace("../index.php")
</script>';

} else {
	echo '<script>
alert("Kullanıcı Kaydı Başarılı");
window.location.replace("../index.php")
</script>';
				}
    ?>