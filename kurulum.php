<meta name="viewport" content="width=device-width, initial-scale=1">	
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}
.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: #333;
  color: white;
  text-align: center;
}
.input-text{
border:none;
outline:none;
box-shadow:none;
border-radius:0px;
border-bottom:1px solid;
border-color:#6f42c1;
color:#222;
font-weight:300;
font-size:18px;
height:32px;
background:transparent;
}
.input-textarea{
border:none;
outline:none;
box-shadow:none;
border-radius:0px;
border-bottom:1px solid;
border-left:1px solid;
border-color:#6f42c1;
color:#222;
font-weight:300;
font-size:18px;
height:32px;
background:transparent;
position: relative !important;
    margin-bottom: 20px !important;
    margin-left: 0px !important;
}
.input-h5{
color:#222;
border:none;
outline:none;
box-shadow:none;
border-radius:0px;
font-weight:300;
font-size:18px;
height:32px;
background:transparent;
font-family:arial;
}

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

<?php
$tara = glob("*.lock");
if (count($tara) > 0) {
echo '
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-ios.css">
<title>pH Analyzer | Kurulum </title>
<meta name="robots" content="noarchive, noindex" />
<div style="padding-left:16px">
<h4>Kurulum Hatası</h4>
<hr></hr>
<p>Zaten Kurulumunu Yapmışsın :)</p>
<hr></hr>
<a class="button button2" align="center" href="index.php">Ana Sayfa</a>
</div>
<br>
<div class="footer">
<p>pH Analyzer Installer | Developed By Ali Can Gönüllü</p>
</div>
<hr></hr>';
die();
} else {
 echo '
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-ios.css">
<title>pH Analyzer | Kurulum </title>
<meta name="robots" content="noarchive, noindex" />';
}
    session_start();
    if (isset($_SESSION['oturum'])){
		echo '<div class="topnav">';
session_regenerate_id();
	echo '</div>';
    }else {
        header('Location: ../index.php');  
    }
if(!isset($_GET['kur'])) {
$sayfa = 'hosgeldiniz';	// eğer boşsa anasayfa varsayalım.
} else {
   $sayfa = $_GET['kur'];
}
switch($sayfa) {

  case 'hosgeldiniz':
  echo '<div style="padding-left:16px">';
  $_SESSION['kurulum_otr'] = time() + 1800;
  $_SESSION['kurulum_otr']=true;
  echo '<h3>Hoşgeldiniz !</h3>
  <hr></hr>
  <h4> AliWAF Kurulumuna Hoşgeldiniz</h4>
  <p> Devam etmek için butona tıklayın</p>
  <hr></hr>
  <a class="button button2" align="right" href="kurulum.php?kur=surumkontrol">Ikinci Aşama</a>';
  $_SESSION['hosgeldiniz'] = time() + 1800;
  $_SESSION['hosgeldiniz']=true;
  echo '</div>';
  break;
//------------------------------------------------
 case 'surumkontrol':
  echo '<div style="padding-left:16px">';
  $_SESSION['mysqlayar'] = time() + 1800;
  echo '<h3>Hoşgeldiniz !</h3>
  <hr></hr>
  <h4> AliWAF Kurulumuna Hoşgeldiniz</h4>
  <p> Sistem Sürümleriniz Kontrol Ediliyor... </p>
  <p> Uyumsuzluk durumunda <font color="red">yüklememeniz</font> önerilir.</p>
  <hr></hr>';
// PHP Versiyon Kontrolü
$desteklenen = '7.3.6';
  if (phpversion() > $desteklenen):
    echo '<font color="red">PHP Sürümü Uyumsuz.</font><br>';
elseif (phpversion() == $desteklenen): // Sözcüklerin birleşik oluşuna dikkat!
    echo '<font color="green">PHP Sürümü Uyumlu.</font><br>';
elseif (phpversion() < $desteklenen): // Sözcüklerin birleşik oluşuna dikkat!
    echo '<font color="green">PHP Sürümü Uyumlu.</font><br>';
else:
    echo '<font color="red">PHP Sürümü Uyumsuz.(Bulunamadı)</font><br>';
endif;
//Komut Kontrolü
if (function_exists('exec')) {
    echo '<font color="green">SSH Komutları Açık.</font>';
} else {
    echo '<font color="red">SSH Komutları Kapalı.</font>';
}
echo '<hr></hr>';
if (function_exists('ssh2_connect')) {
    echo '<font color="green">ssh2_connect() Komutları Açık.</font><br>';
} else {
    echo '<font color="red">ssh2_connect() Kapalı.</font><br>';
}
if (function_exists('shell_exec')) {
    echo '<font color="green">shell_exec() Komutları Açık.</font><br>';
} else {
    echo '<font color="red">shell_exec() Kapalı.</font></p><br>';
}
if (function_exists('include')) {
    echo '<font color="green">include() Komutları Açık.</font>';
} else {
    echo '<font color="red">include() Kapalı.</font></p>';
}
echo '<hr></hr>';
  echo '
  <a class="button button2" align="right" href="kurulum.php?kur=mysqlayar">Üçüncü Aşama</a>';
  $_SESSION['mysqlayar']=true;
  echo '</div>';
  break;
//------------------------------------------------
  case 'mysqlayar':
  echo '<div style="padding-left:16px">';
  $_SESSION['mysqlayar'] = time() + 1800;
  echo '<h3>Hoşgeldiniz !</h3>
  <hr></hr>
  <h4> AliWAF Kurulumuna Hoşgeldiniz</h4>
  <p> MySQL Kurulumu Başladı </p>
<hr></hr>
  <form action="kurulum.php?kur=mysql_post" method="post" enctype="multipart/form-data" class="form-horizontal">

	<strong>MySQL Hostname:</strong>
	<input type="text" name="host" value="localhost" class="form-control" placeholder="MySQL Hostname:" maxlength="15">

	<strong>MySQL DB :</strong>
	<input type="text" name="db" value="ali_waf" class="form-control" placeholder="MySQL Username :" maxlength="15">

	<strong>MySQL User :</strong>
	<input type="text" name="user" value="root" class="form-control" placeholder="MySQL Username :" maxlength="15">

	<strong>MySQL Pass :</strong>
	<input type="password" name="pass" value="1234" class="form-control" placeholder="MySQL Password :" maxlength="15">

<button type="submit" class="button button2">Kaydet</button>
	</form>

  <hr></hr></div>';
  echo '</div>';
  break;
//------------------------------------------------
  case 'mysql_post':
$host = strip_tags($_POST["host"]);
$user = strip_tags($_POST["user"]);
$pass = strip_tags($_POST["pass"]);
$db = strip_tags($_POST["db"]);

$db = new mysqli($host, $user, $pass);
  try {
  $sql = "CREATE DATABASE ali_waf2";
  $sql2 = "CREATE TABLE `admin_giris` (
  `admin_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `pass_word` varchar(255) NOT NULL
)";
  $sql3 = "CREATE TABLE `guard_watch` (
  `kural_id` int(11) NOT NULL,
  `kural_adi` varchar(255) CHARACTER SET utf32 COLLATE utf32_turkish_ci NOT NULL,
  `kural_hakkinda` varchar(255) CHARACTER SET utf32 COLLATE utf32_turkish_ci NOT NULL,
  `kural_icerik` text CHARACTER SET utf32 COLLATE utf32_turkish_ci NOT NULL
)";
$sql4 = "CREATE TABLE `ip_ban` (
  `ip_id` int(11) NOT NULL,
  `ip_adresi` varchar(255) NOT NULL
)";
$sql5 = "INSERT INTO `admin_giris` (`admin_id`, `user_name`, `pass_word`) VALUES
(2, 'admin', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1')";
$sql6 = "INSERT INTO `guard_watch` (`kural_id`, `kural_adi`, `kural_hakkinda`, `kural_icerik`) VALUES
(1, 'SQL Engelleme Kuralı', 'SQL Zaafiyeti Engelleme', '..¿¿½¿¿%¿¿OR¿¿\"¿¿\'¿¿`¿¿concat¿¿join¿¿\\\"¿¿\\\\¿¿tablo_adim¿¿kolon_adim¿¿script¿¿alert¿¿JaVaScRiPT¿¿&quot;¿¿fromCharCode¿¿onmouseover¿¿&#¿¿#&¿¿&#x09;¿¿!¿¿#¿¿$¿¿%¿¿(¿¿)¿¿*¿¿~¿¿+¿¿-¿¿_¿¿,¿¿:¿¿;¿¿?¿¿@[¿¿/¿¿|¿¿\\¿¿]¿¿^¿¿`¿¿//¿¿/¿¿livescript¿¿constructor¿¿:¿¿\'\\ja\\vasc\\ript:alert¿¿¾¿¿¢¿¿order¿¿by¿¿union¿¿table_name¿¿column_name¿¿from¿¿concat¿¿and¿¿AND¿¿limit¿¿SRC¿¿src¿¿meta¿¿embed¿¿xml¿¿XML¿¿x;¿¿x27;¿¿quot¿¿+¿¿UNION¿¿-¿¿-¿¿+¿¿*¿¿’¿¿|'),
(2, 'XSS Engelleme Kuralı', 'XSS Engelleyici', '..¿¿½¿¿%¿¿OR¿¿\\\"¿¿\\\'¿¿`¿¿concat¿¿join¿¿\\\\\\\"¿¿\\\\\\\\¿¿tablo_adim¿¿kolon_adim¿¿script¿¿alert¿¿JaVaScRiPT¿¿&quot;¿¿fromCharCode¿¿onmouseover¿¿&#¿¿#&¿¿&#x09;¿¿!¿¿#¿¿$¿¿%¿¿(¿¿)¿¿*¿¿~¿¿+¿¿-¿¿_¿¿,¿¿:¿¿;¿¿?¿¿@[¿¿/¿¿|¿¿\\\\¿¿]¿¿^¿¿`¿¿//¿¿/¿¿livescript¿¿constructor¿¿:¿¿\\\'\\\\ja\\\\vasc\\\\ript:alert¿¿¾¿¿¢¿¿order¿¿by¿¿union¿¿table_name¿¿column_name¿¿from¿¿concat¿¿and¿¿AND¿¿limit¿¿SRC¿¿src¿¿meta¿¿embed¿¿xml¿¿XML¿¿x;¿¿lt¿¿&gt¿¿x27;¿¿quot¿¿+¿¿UNION¿¿-¿¿-¿¿+¿¿*¿¿’¿¿'),
(3, 'RFI Engelleme', 'RFI Engelleme', '//¿¿etcpasswd¿¿conf¿¿MYD¿¿MYI¿¿ini¿¿{¿¿}¿¿/¿¿#¿¿[¿¿]¿¿&#37;¿¿@¿¿¢¿¿¤¿¿¥¿¿¦¿¿§¿¿©¿¿ª¿¿«¿¿¬¿¿&shy;¿¿®¿¿¯¿¿°¿¿±¿¿²¿¿³¿¿µ¿¿¶¿¿·¿¿¸¿¿¹¿¿º¿¿¼¿¿¾¿¿À¿¿')";
$sql7 = "INSERT INTO `ip_ban` (`ip_id`, `ip_adresi`) VALUES
(2, '127.0.0.1')";
$sql8 = "ALTER TABLE `admin_giris`
  ADD PRIMARY KEY (`admin_id`)";
$sql9 = "ALTER TABLE `guard_watch`
  ADD PRIMARY KEY (`kural_id`)";
$sql10 = "ALTER TABLE `ip_ban`
  ADD PRIMARY KEY (`ip_id`)";
  //Veritabana Aktar
  $db->query($sql);
  $db->query($sql2);
  $db->query($sql3);
  $db->query($sql4);
  $db->query($sql5);
  $db->query($sql6);
  $db->query($sql7);
  $db->query($sql8);
  $db->query($sql9);
  $db->query($sql10);

  }
  catch(PDOException $e)
    {
  $e->getMessage();
    }
// Bağlantı Kontrol
if ($deneme->connect_error) {
    die("Bağlantı Hatası: " . $deneme->connect_error);
}

 $ac = fopen("baglanti.php","r+");
 if(!$ac)
 {
echo '<div style="padding-left:16px">
<h3>Fatal Error !</h3>
<hr></hr>
<h4>Kurulumun Bu Aşamasında Sorun Oluştu</h4>
<code>Dosya yok veya bulunamadı</code>
</div>';
}
$eklenecek_metin = '
<?php
error_reporting(0);
try {
	$ip = "'.$host.'"; //host
	$user = "'.$user.'";  // host id
	$password = "'.$pass.'";  // password local olduğu için varsayılan şifre
	$dbad = "'.$db.'"; // db adı 
	
     $db = new PDO("mysql:host=$ip;dbname=$dbad", "$user", "$password");
     $db->query("SET CHARACTER SET utf8");
     $db->query("SET NAMES utf8");

} catch ( PDOException $e ){
echo "<table>
<center>No MySQL Connection</center>
<center>Bunun Sebebi Bir DDoS Saldırısı Olabilir</center>
<center>Sistem Yöneticinizle Irtibata Geçin</center>
</table>";
}
?>';

fwrite($ac,$eklenecek_metin);
header("Location: kurulum.php?kur=mysqlkomut");
  break;
//------------------------------------------------
  case 'mysqlkomut':
  echo '<div style="padding-left:16px">';
  echo '<h3>Hoşgeldiniz !</h3>
  <hr></hr>
  <h4> AliWAF MySQL Kurulumu Başarılı</h4>
  <p> Devam etmek için butona tıklayın</p>
  <hr></hr>';

  echo '<a class="button button2" align="right" href="kurulum.php?kur=admingiris">Beşinci Aşama</a>';
  $_SESSION['admingiris']=true;
  echo '</div>';
  break;

//------------------------------------------------
  case 'admingiris':
  echo '<div style="padding-left:16px">';
  $_SESSION['admingiris'] = time() + 1800;
  echo '<h3>Hoşgeldiniz !</h3>
  <hr></hr>
  <h4> AliWAF Kurulumuna Hoşgeldiniz</h4>
  <p> Devam etmek için butona tıklayın</p>
  <hr></hr>
  <a class="button button2" align="right" href="kurulum.php?kur=kurallar">Altıncı Aşama</a>';
  $_SESSION['admingiris']=true;
  echo '</div>';
  break;
//------------------------------------------------
  case 'post_admingiris':
  include("baglanti.php");
  echo '<div style="padding-left:16px">';
  echo '<h3>Hoşgeldiniz !</h3>
  <hr></hr>
  <h4> AliWAF Kurulumuna Hoşgeldiniz</h4>
  <p> Devam etmek için butona tıklayın</p>
  <hr></hr>
  <a class="button button2" align="right" href="index.php">Bitiş</a>';
  echo '</div>';
  break;
//------------------------------------------------
  case 'kurallar':
  echo '<div style="padding-left:16px">';
  $_SESSION['kurallar'] = time() + 1800;
  echo '<h3>Hoşgeldiniz !</h3>
  <hr></hr>
  <h4> AliWAF Kurulumuna Hoşgeldiniz</h4>
  <p> Devam etmek için butona tıklayın</p>
  <hr></hr>
  <a class="button button2" align="right" href="kurulum.php?kur=bitis">Yedinci Aşama</a>';
  $_SESSION['kurallar']=true;
  echo '</div>';
  break;
//------------------------------------------------
  case 'bitis':
  echo '<div style="padding-left:16px">';
  $_SESSION['bitis'] = time() + 1800;
  echo '<h3>AliWAF Kurulumu Bitti !</h3>
  <hr></hr>
  <h4> AliWAF Kurulumu Bitti</h4>
  <p> Sitenize WAF sistemini eklemek için aşağıdaki kodu başlık sayfanıza giriniz:</p>';
  ?>
    <code>include("engelle.php");</code>
  <?php
  echo '<p> Devam etmek için butona tıklayın</p>
  <hr></hr>
  <a class="button button2" align="right" href="index.php">Bitiş</a>
  <br>
<div class="footer">
	<p>pH Analyzer Installer | Developed By Ali Can Gönüllü</p>
</div>
<hr></hr>';
$my_file = 'aliwaf.lock';
$içerik .= "Locked\n";
file_put_contents($my_file, $içerik, FILE_APPEND);
  die();
  echo '</div>';
  break;

//------------------------------------------------
  default:
   echo '
   <title>Bulunamadı!</title>
   <h2>Bulunamadı!</h2>
   <p>Böyle bir sayfamız henüz yok, değiştirilmiş ya da silinmiş olabilir.</p>';
}
?>
<br>
<div class="footer">
	<p>pH Analyzer Installer | Developed By Ali Can Gönüllü</p>
</div>
<hr></hr>