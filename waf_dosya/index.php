<!--
Mail : alicangonullu1907@gmail.com
Writed By ALI CAN GONULLU
Respect Us !
-->
<?php
require_once("yetki_kontrol.php");
?>
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
			echo '<td><a class="btn btn-warning btn-md" href="waf_act/w
			af_duzenle.php?id='.$row['kural_id'].'">Düzenle</a></td>';

            echo '</tr>';

        }

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
?>
<script language="JavaScript" type="text/javascript">
function delpost(id)
{
  if (confirm("Silmek istediğinize emin misiniz '" + "'"))
  {
      window.location.href = 'waf_act/waf_sil.php?kuralsil=' + id;
  }
}
</script>



                                            
                                         </tbody>                                              
                                        
                                    </table>