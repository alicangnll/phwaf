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
  <a align="right" href="ytk_kontrol.php?git=portekle">Port Ekle</a>
  <a align="right" href="ytk_kontrol.php?git=methodekle">Method Ekle</a>
  <a align="right" href="ytk_kontrol.php?git=yedekle">Yedekle</a>
  <a align="right" href="ytk_kontrol.php?git=cmdmanage">Komut Yöneticisi</a>
  <a align="right" href="ytk_kontrol.php?git=servercheck">Server Sağlığı</a>
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
<hr></hr>
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
	<hr></hr>
		<table>
	<thead>
	<b>Port Listesi</b>
	<hr></hr>
	<tr>
	<th></th>
	<th>ID</th>
	<th>PORT</th>
	<th></th>
	<th></th>
	</tr>
	</thead>
	<tbody>
	<?php  try {

        $stmt = $db->query('SELECT * FROM port_blok ORDER BY port_id DESC');
	
        while($row = $stmt->fetch()){
            
            echo '<tr>
			<td><a class="button button3" href="javascript:delport('.$row['port_id'].')">Sil</a></td>
			<td>'.$row['port_id'].'</td>';
			?>
				<td><?php echo strip_tags($row['port_no']); ?></td>

<?php

            echo '</tr>';

        }

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
?>
	<script language="JavaScript" type="text/javascript">
function delport(id)
{
  if (confirm("Silmek istediğinize emin misiniz '" + "'"))
  {
      window.location.href = 'waf_islem/waf_delport.php?portsil=' + id;
  }
}
</script>
	</tbody>
	</table>
	<hr></hr>
		<table>
	<thead>
	<tr>
	<th></th>
	<th>ID</th>
	<th>METHOD</th>
	<th></th>
	</tr></thead>
	                                        <tbody>


<?php
    try {

        $stmt = $db->query('SELECT * FROM method_blok ORDER BY method_id DESC');
	
        while($row = $stmt->fetch()){
            
            echo '<tr>
			<td><a class="button button3" href="javascript:delmethod('.$row['method_id'].')">Sil</a></td>
			<td>'.$row['method_id'].'</td>';
			?>
				<td><?php echo strip_tags($row['method_turu']); ?></td>

<?php

            echo '</tr>';

        }

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
?>
<script language="JavaScript" type="text/javascript">
function delmethod(id)
{
  if (confirm("Silmek istediğinize emin misiniz '" + "'"))
  {
      window.location.href = 'waf_islem/waf_method_sil.php?methodsil=' + id;
  }
}
</script>
</tbody>
</table>
<hr></hr>
</div><br>
	<?php
	break;

//-------------------------------------

	//kuralekle başlangıcı
	case 'kuralekle':
    session_start();
    if (isset($_SESSION['oturum'])){
    }else {
        header('Location: ../index.php');  
    }
	echo '<div style="padding-left:16px"><br>
	<h3>Kural Ekle</h3>
	<hr></hr>
	<form action="waf_islem/waf_kayit.php" method="post" enctype="multipart/form-data" class="form-horizontal">
	<strong>Kural Adı:</strong><br>
	<input type="text" name="kuraladi" class="form-control" placeholder="Kural Adı:" maxlength="15">
	<strong>Kural Hakkında :</strong><br>
	<input type="text" name="kuralhakkinda" class="form-control" placeholder="Kural Hakkında:" maxlength="15">
	<strong>Kural İçeriği : (Değer girerken arada ¿¿ kullanın Örnek: *¿¿-¿¿)</strong><br>
	<textarea name="kuralicerik" id="editor" class="form-control" placeholder="Kural İçeriği:" maxlength="50"></textarea><br>
<button type="submit" class="button button2">Kaydet</button>
	</form>
	</div>';
	break;

	//Admin Ekleme
		case 'adminekle':
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
<button type="submit" class="button button2">Kaydet</button>
	</form>
	</div>';
	break;
	
	case 'methodekle':
    session_start();
    if (isset($_SESSION['oturum'])){
    }else {
        header('Location: ../index.php');  
    }
	//Kontrol Bitti
	echo '<div style="padding-left:16px"><br>
	<h3>Kural Ekle</h3>
	<hr></hr>
	<form action="waf_islem/waf_method_kayit.php" method="post" enctype="multipart/form-data" class="form-horizontal">
	<strong>Method Adı:</strong><br>
	<input type="text" name="method_adi" class="form-control" placeholder="Kural Adı:" maxlength="15"> <br>
	<strong>Method Hakkında :</strong><br>
	<input type="text" name="method_bilgisi" class="form-control" placeholder="Kural Hakkında:" maxlength="15"><br>
	<strong>Method Tipi :</strong><br>
	<input type="text" name="method_turu" class="form-control" placeholder="Kural Hakkında:" maxlength="15"><br>
<button type="submit" class="button button2">Kaydet</button>
	</form>
	</div>';
	break;

	//IP Ekleme
	case 'ipekle':
    session_start();
    if (isset($_SESSION['oturum'])){
    }else {
        header('Location: ../index.php');  
    }
	echo '<div style="padding-left:16px"><br>
	<h3>IP Ekle</h3>
	<hr></hr>
	<form action="waf_islem/waf_ipkayit.php" method="post" enctype="multipart/form-data" class="form-horizontal">
	<br><strong>IP Adresi:</strong><br>
	<input type="text" name="ipadres" class="form-control" placeholder="Kural Adı:" maxlength="15"><br>
	<br><button type="submit" class="button button2">Kaydet</button>
	</form>
	</div>';
	break;
	
		//kuralduzenle başlangıcı
	case 'kuralduzenle':
    session_start();
    if (isset($_SESSION['oturum'])){
    }else {
        header('Location: ../index.php');  
    }
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
<td><p><input class="button button2" type='submit' name='submit' value='Güncelle'></p></td></table>
</form>
</div>

	<?php
	break;

	//Admin Düzenleme Başlangıç
	case 'admduzenle':
    session_start();
    if (isset($_SESSION['oturum'])){
    }else {
        header('Location: ../index.php');  
    } 
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
<td><p><input class="button button2" type='submit' name='submit' value='Güncelle'></p></td></table>
</form>
</div>
	<?php
	break;

// Terminal Girisi	
		case 'cmdmanage':
    session_start();
    if (isset($_SESSION['oturum'])){
    }else {
        header('Location: ../index.php');  
    }
?>
	<br><div style="padding-left:16px"> 
	<title>Komut Girişi</title>
	<h3>Komut Girişi</h3>
	<hr></hr>
	<form action="?git=cmdmanage" method="post">
	<input type="text" name="komut" class="form-control" placeholder="Komutu : "></p>
	<input class="button button2" type='submit' name='submit' value='Komut Giriş'><br>
	</form>
	<hr></hr>

	<?php
if (function_exists('exec')) {
    echo '<font color="green">SSH Komutları Açık.</font><br />';
} else {
    echo '<font color="red">SSH Komutları Kapalı.</font><br />';
}
		$giris_kisim = $_REQUEST['komut'];
                $_SESSION['gecmis_komut'] = $giris_kisim;
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
echo '<hr></hr>
<p>Yolladığınız Komut : '.$_SESSION['gecmis_komut'].'<hr></hr>';
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

case 'yedekle':
echo '<br><div style="padding-left:16px">
<p>MySQL Yedekleme</p>
<hr></hr>'; 
include("../baglanti.php");
if (function_exists('exec')) {
    echo '<font color="green">SSH Komutları Açık.</font><br />';
} else {
    echo '<font color="red">SSH Komutları Kapalı.</font><br />';
}
echo '<hr></hr>
<p>Yakında</p>';
	break;


	//ServerCheck Başladı
	case 'servercheck':
echo '<br><div style="padding-left:16px">'; 
session_start();
    if (isset($_SESSION['oturum'])){
    	function port_kontrol($host, $port, $timeout) { 
  $tB = microtime(true); 
  $fP = fSockOpen($host, $port, $errno, $errstr, $timeout); 
  if (!$fP) { 
  	return ' <font color="red">Alınamadı</font>'; 
  } 
  $tA = microtime(true); 
  return round((($tA - $tB) * 1000), 0)." ms"; 
}
    }else {
        header('Location: ../index.php');  
    }
echo '<h3> Server Kontrol </h3>
<hr></hr>
<p> Giriş Port Kontrolü</p>';
echo '<p> Ping Değeri : '.port_kontrol($_SERVER['SERVER_NAME'], 80, 10).'</p>';
if(fsockopen($_SERVER['SERVER_NAME'],80))
{
echo '<p style="color:green;">'.$_SERVER['SERVER_NAME'].':80 : Açık</p>';
}
else
{
echo '<p style="color:red;">'.$_SERVER['SERVER_NAME'].':80 : Kapalı</p>';
}
echo '<hr></hr>
<p> HTTPS Port Kontrolü</p>';
echo '<p> Ping Değeri : '.port_kontrol($_SERVER['SERVER_NAME'], 443, 10).'</p>';
if(fsockopen($_SERVER['SERVER_NAME'],443))
{
echo '<p style="color:green;">'.$_SERVER['SERVER_NAME'].':443 : Açık</p>';
}
else
{
echo '<p style="color:red;">'.$_SERVER['SERVER_NAME'].':443 : Kapalı</p>';
}
echo '<hr></hr>
<p> MySQL Port Kontrolü</p>';
echo '<p> Ping Değeri : '.port_kontrol($_SERVER['SERVER_NAME'], 3306, 10).'</p>';
if(fsockopen($_SERVER['SERVER_NAME'],3306))
{
echo '<p style="color:green;">'.$_SERVER['SERVER_NAME'].':3306 : Açık</p>';
}
else
{
echo '<p style="color:red;">'.$_SERVER['SERVER_NAME'].':3306 : Kapalı</p>';
}
echo '<hr></hr>
<p> SSH Port Kontrolü</p>';
echo '<p> Ping Değeri : '.port_kontrol($_SERVER['SERVER_NAME'], 21, 10).'</p>';
if(fsockopen($_SERVER['SERVER_NAME'],21))
{
echo '<p style="color:green;">'.$_SERVER['SERVER_NAME'].':21 : Açık</p>';
}
else
{
echo '<p style="color:red;">'.$_SERVER['SERVER_NAME'].':21 : Kapalı</p>';
}
echo '
</div>';
	break;
		case 'portekle':
    session_start();
    if (isset($_SESSION['oturum'])){
    }else {
        header('Location: ../index.php');  
    }
	?>
<div style="padding-left:16px"><br>
<form action="waf_islem/waf_portekle.php" method="post">
<strong>Port Adı :</strong><br>
<input type="text" name="portadi" class="form-control" placeholder="Port Adı : "></p><br>
<strong>Port Hakkında :</strong><br>
<input type="text" name="portbilgisi" class="form-control" placeholder="Port Hakkında : "></p><br>
<strong>Port Numarası :</strong><br>
<input type="text" name="portno" class="form-control" placeholder="Port Numarası : "></p><br></p><br>
<td><p><input class="button button2" type='submit' name='submit' value='Ekle'></p></td></table>
</form>
</div>

	<?php
	break;
	default:
   echo '
   <title>Bulunamadı!</title>
   <h2>Bulunamadı!</h2>
   <p>Böyle bir sayfamız henüz yok, değiştirilmiş ya da silinmiş olabilir.</p>'; // hiç birisi değilse 404 varsayalim
}
	?>
	<style>
.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: #333;
  color: white;
  text-align: center;
}
</style>
<br>
<div class="footer">
	<p>pH Analyzer | Developed By Ali Can Gönüllü</p>
</div>
<hr></hr>