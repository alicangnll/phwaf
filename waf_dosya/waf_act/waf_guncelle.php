<?php
include ("../yetki_kontrol.php");
	$update = $db->prepare("UPDATE guard_watch SET kural_adi = :kuraladi2 , kural_hakkinda = :kuralhakkinda2 , kural_icerik = :kuralicerik2 WHERE kural_id = :gonderid ");
	$update->bindValue(':gonderid', $_POST['gonderid']);
	$update->bindValue(':kuraladi2', $_POST['kuraladi2']);
	$update->bindValue(':kuralhakkinda2', $_POST['kuralhakkinda2']);
	$update->bindValue(':kuralicerik2', $_POST['kuralicerik2']);
	$update->execute();
	if($update){
echo '<script>
alert("Kural Güncellendi");
window.location.replace("../index.php")
</script>';
}?>