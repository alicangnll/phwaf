<?php include ("../yetki_kontrol.php"); 
	$update = $db->prepare("INSERT INTO guard_ipban(ip_adresi) VALUES (:ipadresi) ");
	$update->bindValue(':ipadresi', $_POST['ipadres']);
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
<button type="button" class="close" data-dismiss="alert" aria-hidden="true" href="../index.php" >x</button>
<i class="fa fa-check"></i><strong> IP Listesini</strong> kontrol ediniz! | <a align="right" class="btn btn-success btn-md" href="../index.php">Devam</a>
</div></div></div></div></div></div></div></div>';
}