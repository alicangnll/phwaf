<?php
include ("baslik.php");
	$update = $db->prepare("UPDATE guard_watch SET kural_adi = :kuraladi2 , kural_hakkinda = :kuralhakkinda2 , kural_icerik = :kuralicerik2 WHERE kural_id = :gonderid ");
	$update->bindValue(':gonderid', $_POST['gonderid']);
	$update->bindValue(':kuraladi2', $_POST['kuraladi2']);
	$update->bindValue(':kuralhakkinda2', $_POST['kuralhakkinda2']);
	$update->bindValue(':kuralicerik2', $_POST['kuralicerik2']);
	$update->execute();
	if($update){
echo '<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid"><div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
							<div class="alert alert-success alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true" href="../guardman.php" >x</button>
<i class="fa fa-check"></i><strong> Konular Güncellendi </strong> kontrol ediniz! | <a align="right" class="btn btn-success btn-md" href="../guardman.php">Devam</a>
</div></div></div></div></div></div></div></div>';
}
include("alt.php"); ?>