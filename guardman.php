<?php include("header.php"); ?>

<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
					<?php
if(isset($_GET['kuralsil'])){ 

    $stmt = $db->prepare('DELETE FROM guard_watch WHERE kural_id = :postID') ;
    $stmt->execute(array(':postID' => $_GET['kuralsil']));
	if($stmt){
echo '<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid"><div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
							<div class="alert alert-success alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true" href="guardman.php" >x</button>
<i class="fa fa-check"></i><strong> Kural Silme İşlemi </strong> Başarili kontrol ediniz! <a align="right" class="btn btn-success btn-md" href="guardman.php">Devam</a>
</div></div></div></div></div></div></div></div>';
} else {
	echo '<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid"><div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
							<div class="alert alert-success alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true" href="guardman.php" >x</button>
<i class="fa fa-check"></i><strong> Kural Silme İşlemi </strong> Başarısız kontrol ediniz! <a align="right" class="btn btn-success btn-md" href="guardman.php">Devam</a>
</div></div></div></div></div></div></div></div>';
}
}
		?>
                        
              <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th></th>
												<th>ID</th>
                                                <th>BASLIK</th>
												<th>HAKKINDA</th>
												<th></th>
                                            </tr>
                                        </thead>
                                        <tbody>


<?php
    try {

        $stmt = $db->query('SELECT * FROM guard_watch ORDER BY kural_id DESC');
	
        while($row = $stmt->fetch()){
            
            echo '<tr>
			<td><a class="btn btn-danger btn-md" href="javascript:delpost('.$row['kural_id'].')">Sil</a></td>
			<td>'.$row['kural_id'].'</td>';
			?>
				<td><?php echo strip_tags($row['kural_adi']); ?></td>
				<td><?php echo strip_tags($row['kural_hakkinda']); ?></td>

<?php
			echo '<td><a class="btn btn-warning btn-md" href="eklenti/kuralduzenle.php?id='.$row['kural_id'].'">Düzenle</a></td>';

            echo '</tr>';

        }

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
?>


                                            
                                         </tbody>                                              
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<table><td><a align="right" class="btn btn-success btn-md" href="eklenti/kuralekle.php">Konu Ekle</a></td></table>
</table>
<script language="JavaScript" type="text/javascript">
function delpost(id)
{
  if (confirm("Silmek istediğinize emin misiniz '" + "'"))
  {
      window.location.href = 'guardman.php?kuralsil=' + id;
  }
}
</script>


<style>
.alert {
    padding: 20px;
    background-color: #f44336;
    color: white;
    opacity: 1;
    transition: opacity 0.6s;
    margin-bottom: 15px;
}

.alert.success {background-color: #4CAF50;}
.alert.info {background-color: #2196F3;}
.alert.warning {background-color: #ff9800;}

.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

.closebtn:hover {
    color: black;
}
</style>
			
			
                                        </div>                                      
                                    </div>
                                        </div>
<?php include("footer.php"); ?>
    </div>
</div>
    </div>
