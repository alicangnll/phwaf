<?php include ("../yetki_kontrol.php"); 														
	$update = $db->prepare("INSERT INTO guard_watch(kural_adi, kural_hakkinda, kural_icerik) VALUES (:kuraladi, :kuralhakkinda, :kuralicerik) ");
	$update->bindValue(':kuraladi', $_POST['kuraladi']);
	$update->bindValue(':kuralhakkinda', $_POST['kuralhakkinda']);
	$update->bindValue(':kuralicerik', $_POST['kuralicerik']);
//Post Empty
	$update->execute();
	if($update){
echo '<script>
alert("Kural Güncellendi");
window.location.replace("../index.php")
</script>';
}
    ?>
