<?php 
include ("../yetki_kontrol.php");
try {

    $stmt = $db->prepare('SELECT * FROM guard_watch WHERE kural_id = :gonderid');
    $stmt->execute(array(':gonderid' => $_GET['id']));
    $row = $stmt->fetch(); 

} catch(PDOException $e) {
    echo $e->getMessage();
}
?>

<form action='waf_guncelle.php' method='post'>
    <input type='hidden' name='gonderid' value='<?php echo $row['kural_id'];?>'>

	<strong>Kural Adı :</strong>
                                            <div class="row form-group">
                                                 <div class="col-12 col-md-9">
		<input type="text" name="kuraladi2" class="form-control" value="<?php echo htmlspecialchars ($row['kural_adi']);?>" placeholder="Kural Adı : "></p>
	</div></div>

    <strong>Kural Hakkında :</strong>
                                            <div class="row form-group">
                                                 <div class="col-12 col-md-9">
    <textarea class="textarea is-danger" name='kuralhakkinda2' cols='60' rows='10'><?php echo htmlspecialchars ($row['kural_hakkinda']);?></textarea></p>
</div></div>

   <strong>Kural İçeriği : (Değer girerken arada ¿¿ kullanın Örnek: *¿¿-¿¿)</strong>
                                            <div class="row form-group">
                                                 <div class="col-12 col-md-9">
    <textarea class="textarea is-danger" name='kuralicerik2' cols='60' rows='10'><?php echo htmlspecialchars ($row['kural_icerik']);?></textarea></p>
	</div></div>
	
											<div class="card-footer">
</div>
<td><p><input class="btn btn-warning btn-md" type='submit' name='submit' value='Güncelle'></p></td></table>
</form>
