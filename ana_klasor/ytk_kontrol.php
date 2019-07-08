<?php 
require_once("../baglanti.php");
require_once("../ozel_fonksiyon.php");
echo '
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-ios.css">
<title>pH Analyzer</title>
<meta name="robots" content="noarchive, noindex" />';
    session_start();
    if (isset($_SESSION['oturum'])){
		echo '<div class="topnav">'
	?>
	<style>
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 13px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 13px;
  margin: 4px 2px;
  cursor: pointer;
}

.button2 {background-color: #008CBA;} /* Blue */
.button3 {background-color: #f44336;} /* Red */ 
.button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
.button5 {background-color: #555555;} /* Black */
</style>
  <a href="ytk_kontrol.php">Ana Sayfa</a>
  <a align="right" href="ytk_kontrol.php?git=kuralekle">Kural Ekle</a>
  <a align="right" href="ytk_kontrol.php?git=ipekle">IP Ekle</a>
  <a align="right" href="ytk_kontrol.php?git=adminekle">Admin Ekle</a>
  <a align="right" href="ytk_kontrol.php?git=cmdmanage">Komut Yöneticisi</a>
  <a align="right" href="ytk_kontrol.php?git=cikis">Çıkış</a>
	<?php
	echo '</div>';
    }else {
        header('Location: ../index.php');  
    }
if(!isset($_GET['git'])) {
$sayfa = 'anasayfa';	// eğer boşsa anasayfa varsayalım.
} else {
   $sayfa = $_GET['git'];
}
switch($sayfa) {
	//ana_sayfa başlangıcı
	case 'anasayfa':
	// Kontrol Basladi
    session_start();
    if (isset($_SESSION['oturum'])){
    }else {
        header('Location: ../index.php');  
    }
	$host = $_SERVER['SERVER_NAME'];
	
	echo '<title> pH Analyzer | '.$_SESSION['kullanici_adi'].'</title>';
	//Kontrol Bitti
	echo '<div style="padding-left:16px">
	<h3>Hoşgeldiniz Sayın <b>'.$_SESSION['kullanici_adi'].'</b></h3>
	<hr></hr>
	<p>IP Adresi : <b>'.$_SERVER['REMOTE_ADDR'].'</b></p>
	<p>Site Adı : <b>'.$host.'</b></p>
	<p>User-Agent : <b>'.$_SERVER['HTTP_USER_AGENT'].'</b></p>
	<p>Server Protokolü : <b>'.$_SERVER['SERVER_PROTOCOL'].'</b></p>
	<p>PHP Versiyon : <b>'.phpversion().'</b></p>';
	?>
	<hr></hr>
	<table>
	<thead>
	<tr>
	<th></th>
	<th>ID</th>
	<th>BASLIK</th>
	<th>HAKKINDA</th>
	<th></th>
	</tr></thead>
	                                        <tbody>


<?php
    try {

        $stmt = $db->query('SELECT * FROM guard_watch ORDER BY kural_id DESC');
	
        while($row = $stmt->fetch()){
            
            echo '<tr>
			<td><a class="button button3" href="javascript:delpost('.$row['kural_id'].')">Sil</a></td>
			<td>'.$row['kural_id'].'</td>';
			?>
				<td><?php echo strip_tags($row['kural_adi']); ?></td>
				<td><?php echo strip_tags($row['kural_hakkinda']); ?></td>

<?php
			echo '<td><a class="button button2" href="ytk_kontrol.php?git=kuralduzenle&id='.$row['kural_id'].'">Düzenle</a></td>';

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
      window.location.href = 'waf_islem/waf_sil.php?kuralsil=' + id;
  }
}
</script>
</tbody>
</table>
<hr></hr>
	<table>
	<thead>
	<b>IP Listesi</b>
	<hr></hr>
	<tr>
	<th></th>
	<th>ID</th>
	<th>IP</th>
	<th></th>
	<th></th>
	</tr>
	</thead>
	<tbody>
	<?php  try {

        $stmt = $db->query('SELECT * FROM ip_ban ORDER BY ip_id DESC');
	
        while($row = $stmt->fetch()){
            
            echo '<tr>
			<td><a class="button button3" href="javascript:delip('.$row['ip_id'].')">Sil</a></td>
			<td>'.$row['ip_id'].'</td>';
			?>
				<td><?php echo strip_tags($row['ip_adresi']); ?></td>

<?php

            echo '</tr>';

        }

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
?>
	<script language="JavaScript" type="text/javascript">
function delip(id)
{
  if (confirm("Silmek istediğinize emin misiniz '" + "'"))
  {
      window.location.href = 'waf_islem/waf_ipsil.php?ipsil=' + id;
  }
}
</script>
	</tbody>
	</table>

<table>
	<thead>
	<hr></hr>
	<b>Admin Listesi</b>
	<hr></hr>
	<tr>
	<th></th>
	<th>ID </th>
	<th>USERNAME</th>
	<th></th>
	</tr>
	</thead>
	<tbody>
	<?php  try {

        $stmt = $db->query('SELECT * FROM admin_giris ORDER BY admin_id DESC');
	
        while($row = $stmt->fetch()){
            
            echo '<tr>
			<td><a class="button button3" btn-md" href="javascript:deladm('.$row['admin_id'].')">Sil</a></td>
			<td>'.$row['admin_id'].'</td>';
			?>
				<td><?php echo strip_tags($row['user_name']); ?></td>

<?php
			echo '<td><a class="button button2" href="ytk_kontrol.php?git=admduzenle&id='.$row['admin_id'].'">Düzenle</a></td>';
            echo '</tr>';

        }

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
?>
	<script language="JavaScript" type="text/javascript">
function deladm(id)
{
  if (confirm("Silmek istediğinize emin misiniz '" + "'"))
  {
      window.location.href = 'waf_islem/waf_adminsil.php?admsil=' + id;
  }
}
</script>
	</tbody>
	</table>
</div><br>
	<?php
	break;
	//ana_sayfa bitişi
//-------------------------------------
	//kuralekle başlangıcı
	case 'kuralekle':
	// Kontrol Basladi
    session_start();
    if (isset($_SESSION['oturum'])){
    }else {
        header('Location: ../index.php');  
    }
	//Kontrol Bitti
	echo '<div style="padding-left:16px"><br>
	<h3>Kural Ekle</h3>
	<hr></hr>
	<form action="waf_islem/waf_kayit.php" method="post" enctype="multipart/form-data" class="form-horizontal">
	<strong>Kural Adı:</strong><br>
	<input type="text" name="kuraladi" class="form-control" placeholder="Kural Adı:" maxlength="15"> <br>
	<strong>Kural Hakkında :</strong><br>
	<input type="text" name="kuralhakkinda" class="form-control" placeholder="Kural Hakkında:" maxlength="15"><br>
	<strong>Kural İçeriği : (Değer girerken arada ¿¿ kullanın Örnek: *¿¿-¿¿)</strong><br>
	<textarea name="kuralicerik" id="editor" class="form-control" placeholder="Kural İçeriği:" maxlength="50"></textarea><br>
<button type="submit" class="btn btn-primary btn-md">Kaydet</button>
	</form>
	</div>';
	break;
	//Admin Ekleme
		case 'adminekle':
	// Kontrol Basladi
    session_start();
    if (isset($_SESSION['oturum'])){
    }else {
        header('Location: ../index.php');  
    }
	//Kontrol Bitti
	echo '<div style="padding-left:16px"><br>
	<h3>Kural Ekle</h3>
	<hr></hr>
	<form action="waf_islem/waf_adminkayit.php" method="post" enctype="multipart/form-data" class="form-horizontal">
	<strong>Kullanıcı Adı:</strong><br>
	<input type="text" name="kadi" class="form-control" placeholder="Kural Adı:" maxlength="15"> <br>
	<strong>Şifre :</strong><br>
	<input type="password" name="sifre" class="form-control" placeholder="Kural Hakkında:" maxlength="15"><br>
<button type="submit" class="btn btn-primary btn-md">Kaydet</button>
	</form>
	</div>';
	break;
	//IP Ekleme
	case 'ipekle':
	// Kontrol Basladi
    session_start();
    if (isset($_SESSION['oturum'])){
    }else {
        header('Location: ../index.php');  
    }
	//Kontrol Bitti
	echo '<div style="padding-left:16px"><br>
	<h3>IP Ekle</h3>
	<hr></hr>
	<form action="waf_islem/waf_ipkayit.php" method="post" enctype="multipart/form-data" class="form-horizontal">
	<br><strong>IP Adresi:</strong><br>
	<input type="text" name="ipadres" class="form-control" placeholder="Kural Adı:" maxlength="15"><br>
	<br><button type="submit" class="btn btn-primary btn-md">Kaydet</button>
	</form>
	</div>';
	break;
	
		//kuralekle başlangıcı
	case 'kuralduzenle':
	// Kontrol Basladi
    session_start();
    if (isset($_SESSION['oturum'])){
    }else {
        header('Location: ../index.php');  
    }
	?>
	<?php 
try {

    $stmt = $db->prepare('SELECT * FROM guard_watch WHERE kural_id = :gonderid');
    $stmt->execute(array(':gonderid' => $_GET['id']));
    $row = $stmt->fetch(); 

} catch(PDOException $e) {
    echo $e->getMessage();
}
?>
<div style="padding-left:16px"><br>
<form action="waf_islem/waf_guncelle.php" method="post">
<input type='hidden' name='gonderid' value='<?php echo $row['kural_id'];?>'>
<strong>Kural Adı :</strong><br>
<input type="text" name="kuraladi2" class="form-control" value="<?php echo htmlspecialchars ($row['kural_adi']);?>" placeholder="Kural Adı : "></p><br>
<strong>Kural Hakkında :</strong><br>
<textarea class="textarea is-danger" name='kuralhakkinda2' cols='60' rows='10'><?php echo htmlspecialchars ($row['kural_hakkinda']);?></textarea></p><br>
<strong>Kural İçeriği : (Değer girerken arada ¿¿ kullanın Örnek: *¿¿-¿¿)</strong><br>
<textarea class="textarea is-danger" name='kuralicerik2' cols='60' rows='10'><?php echo htmlspecialchars ($row['kural_icerik']);?></textarea></p><br>
<td><p><input class="btn btn-warning btn-md" type='submit' name='submit' value='Güncelle'></p></td></table>
</form>
</div>

	<?php
	break;
	case 'admduzenle':
	// Kontrol Basladi
    session_start();
    if (isset($_SESSION['oturum'])){
    }else {
        header('Location: ../index.php');  
    }
	?>
	<?php 
try {

    $stmt = $db->prepare('SELECT * FROM admin_giris WHERE admin_id = :gonderid');
    $stmt->execute(array(':gonderid' => $_GET['id']));
    $row = $stmt->fetch(); 

} catch(PDOException $e) {
    echo $e->getMessage();
}
?>
<div style="padding-left:16px"><br>
<form action="waf_islem/waf_adminguncelle.php" method="post">
<input type='hidden' name='gonderid' value='<?php echo $row['admin_id'];?>'>
<strong>Admin Username :</strong><br>
<input type="text" name="kadi" class="form-control" value="<?php echo htmlspecialchars ($row['user_name']);?>" placeholder="Admin Username : "></p><br>
<strong>Admin Password :</strong><br>
<input type="password" name="sifre" class="form-control" value="<?php echo htmlspecialchars ($row['pass_word']);?>" placeholder="Admin Password : "></p><br>
<td><p><input class="btn btn-warning btn-md" type='submit' name='submit' value='Güncelle'></p></td></table>
</form>
</div>

	<?php
	break;
// Terminal Girisi	
		case 'cmdmanage':
	// Kontrol Basladi
    session_start();
    if (isset($_SESSION['oturum'])){
    }else {
        header('Location: ../index.php');  
    }
?>
	<br><div style="padding-left:16px"> 
	<title>Komut Girişi</title>
	<b>Komut Girişi</b>
	<hr></hr>
	<form action="?git=cmdmanage" method="post">
	<input type="text" name="komut" class="form-control" placeholder="Komutu : "></p>
	<input class="btn btn-warning btn-md" type='submit' name='submit' value='Komut Giriş'><br>
	</form>
	<hr></hr>
	    <?php
		$giris_kisim = $_REQUEST['komut'];
		$komut_giris = base64_encode($giris_kisim);
        $decoded_command = base64_decode($komut_giris);
        echo str_repeat("<br>",2);
        exec($decoded_command . " 2>&1", $output, $return_status);
        if (isset($return_status)):
            if ($return_status !== 0):
                foreach ($output as &$line) {
					echo '<div class="w3-panel w3-ios-light-grey"><code>';
                    echo strip_tags($line);
					echo '</code></div>';
                };
            elseif ($return_status == 0 && empty($output)):
            else:
                foreach ($output as &$line) {
					echo '<pre><code>';
                    echo strip_tags($line);
					echo '</code></pre>';
                };
            endif;
        endif;
	echo '</div>'; 
	break;
	//cikis basladi
	case 'cikis':
session_start();
session_destroy();
session_unset();
echo (" Başarılı ");
header ("Location: ../index.php"); 
	break;
// Çıkış işlemi verildi
	// 404 Sayfası
	default:
   echo '
   <title>Bulunamadı!</title>
   <h2>Bulunamadı!</h2>
   <p>Böyle bir sayfamız henüz yok, değiştirilmiş ya da silinmiş olabilir.</p>'; // hiç birisi değilse 404 varsayalim
}
	?>