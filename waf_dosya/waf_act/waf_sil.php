<?php
include ("../yetki_kontrol.php");
if(isset($_GET['kuralsil'])){ 

    $stmt = $db->prepare('DELETE FROM guard_watch WHERE kural_id = :postID') ;
    $stmt->execute(array(':postID' => $_GET['kuralsil']));
	if($stmt){
echo '<script>
alert("Kural Silindi");
window.location.replace("../index.php")
</script>';
} else {
	echo '<script>
	alert("Kural Silinemedi");
	window.location.replace("../index.php")</script>';
}
}
		?>