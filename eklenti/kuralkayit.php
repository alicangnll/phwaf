<?php
include ("baslik.php");
?>															
<?php
	$update = $db->prepare("INSERT INTO guard_watch(kural_adi, kural_hakkinda, kural_icerik) VALUES (:kuraladi, :kuralhakkinda, :kuralicerik) ");
	$update->bindValue(':kuraladi', $_POST['kuraladi']);
	$update->bindValue(':kuralhakkinda', $_POST['kuralhakkinda']);
	$update->bindValue(':kuralicerik', $_POST['kuralicerik']);
//Post Empty
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
<i class="fa fa-check"></i><strong> Kuralları </strong> kontrol ediniz! | <a align="right" class="btn btn-success btn-md" href="../guardman.php">Devam</a>
</div></div></div></div></div></div></div></div>';
}
    ?>
<?php include("alt.php"); ?>
