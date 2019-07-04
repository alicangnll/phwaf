<?php include ("../yetki_kontrol.php"); ?>

                        <?php
if(isset($_GET['postsil'])){ 

    $stmt = $db->prepare('DELETE FROM kadi_giris WHERE usr_id = :postID') ;
    $stmt->execute(array(':postID' => $_GET['postsil']));

    echo '<script>
alert("Kullanıcı Silindi");
window.location.replace("../index.php")
</script>>';
    exit;
} 
?>
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>ADMİN ADİ</th>
                                                <th>EYLEMLER</th>
                                            </tr>
                                        </thead>
                                        <tbody>


<?php
    try {

        $stmt = $db->query('SELECT usr_id, kadi FROM kadi_giris ORDER BY usr_id DESC');
        while($row = $stmt->fetch()){
            
            echo '<tr>';
            echo '<td>'.$row['usr_id'].'</td>';
			?>
			
            <td><?php echo strip_tags($row['kadi']); ?></td>
<td>
                <a class="btn btn-primary btn-md" href="adm_duzenle.php?id=<?php echo $row['usr_id'];?>">Düzenle</a> | 
                <a class="btn btn-primary btn-md" href="javascript:postsil('<?php echo $row['usr_id'];?>','')">Sil</a>
            </td>
<?php

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

<table><tr><td><a class="btn btn-primary btn-md" href="adm_ekle.php">Ekle</a></td></tr></table>
</table>

			<script language="JavaScript" type="text/javascript">
function postsil(id, title)
{
  if (confirm("Silmek istediğinize emin misiniz ? '" + title + "'"))
  {
      window.location.href = 'adm_icerik.php?postsil=' + id;
  }
}
</script>
			
			
                                        </div>                                      
                                    </div>
                                        </div> 								
                                    </div>
                                </div>
</div>
			
