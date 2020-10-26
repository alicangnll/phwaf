<?php
echo '<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PXE Installer</title>
</head>
<style>
@fontName:  -apple-system,
            system-ui,
            BlinkMacSystemFont,
            "Segoe UI", "Roboto", "Ubuntu",
            "Helvetica Neue", sans-serif;
@media (max-width:800px) {
body {
  background-image: url("https://source.unsplash.com/1080x1920/?turkey,türkiye,atatürk,şehir,manzara,deniz");
  align-items: center;
  justify-content: center;
}
}
body {
  background-image: url("https://source.unsplash.com/1920x1080/?turkey,türkiye,atatürk,şehir,manzara,deniz");
  align-items: center;
  justify-content: center;
}
</style>';
if(!isset($_GET['git'])) {
$sayfa = 'index';
} elseif(empty($_GET['git'])) {

if(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2) == "tr") {
$getir->Error("Sayfa Bulunamadı");
} else {
$getir->Error("Page Not Found");
}

} else {
$sayfa = strip_tags($_GET['git']);
}

switch ($sayfa) {

case 'index':
echo '<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>Merhabalar</b>
<hr></hr>
<p>PHP WAF Yönetim Paneli kurulumuna hoşgeldiniz. Devam etmek için lütfen devam tuşuna tıklayın.</p><br>
<a type="button" href="install.php?git=first_install" class="btn btn-dark">Devam Et</a>
</div>
</div></body>';
break;

case 'first_install':
echo '<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>Kuruluma Başlıyoruz</b>
<hr></hr>
<p>PHP WAF Yönetim Paneli kurulumu öncesi birkaç kontrol yapmalıyız.</p>

<table class="table">
<thead>
<tr>
<th scope="col">Fonksiyon</th>
<th scope="col">Durum</th>
</tr></thead>
<tbody>';
if(!extension_loaded('pdo_mysql')){
	echo '<tr>
	<td>PDO MySQL</td>
	<td><font color="red">No</font></td>
	</tr><br><br>';
} else {
	echo '<tr>
	<td>PDO MySQL</td>
	<td><font color="green">OK</font></td>
	</tr>';
}
if (!function_exists('shell_exec')) {
  echo '<tr>
  <td>Shell EXEC</td>
  <td><font color="red">No</font></td>
  </tr><br><br>';
} else {
  echo '<tr>
  <td>Shell EXEC</td>
  <td><font color="green">OK</font></td>
  </tr><br>';
}
echo '</tbody></table>
<a href="install.php?git=sql_install" class="btn btn-dark">Devam</a>
</div></div></body>';
break;

case 'sql_install':
echo '<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>SQL Bilgisi</b>
<hr></hr>
<p>Lütfen SQL bilgilerini giriniz.</p>
  
<form action="install.php?git=sqlpost" method="post">

<div class="form-group">
<label for="exampleInputEmail1">SQL Server</label>
<input type="text" class="form-control" name="sqlserver" placeholder="localhost">
</div>

<div class="form-group">
<label for="exampleInputEmail1">SQL Username</label>
<input type="text" class="form-control" name="sqlusr" placeholder="root">
</div>
	
<div class="form-group">
<label for="exampleInputEmail1">SQL Password</label>
<input type="password" class="form-control" name="sqlpasswd" placeholder="1234">
</div>
<button type="submit" class="btn btn-dark">İleri / Next</button>
</form></div></div></body>';
break;
	
case 'sqlpost':
$mysqlserv = strip_tags($_POST["sqlserver"]);
$mysqlusr = strip_tags($_POST["sqlusr"]);
$mysqlpass = strip_tags($_POST["sqlpasswd"]);
$conn = new mysqli($mysqlserv, $mysqlusr, $mysqlpass);
$conn->query("SET CHARACTER SET 'utf8'");
$conn->query("SET NAMES 'utf8'");

if ($conn->connect_error) {
die('<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>MySQL Kurulumu | HATA</b>
<hr></hr>
<code>
'.$conn->connect_error.'<br>
</code><br>
<div class="form-group">
<br><br><a href="install.php?git=sql_install" " class="btn btn-dark">Tekrar Dene</button><br>
</div></div></div></body>');
}
$sql = "CREATE DATABASE ali_waf";

if ($conn->query($sql) === TRUE) {
} else {
die('<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>MySQL Kurulumu | HATA</b>
<hr></hr>
<code>
'.$conn->error.'<br>
</code><br>
<div class="form-group">
<br><br><a href="install.php?git=sql_install" " class="btn btn-dark">Tekrar Dene</button><br>
</div></div></div></body>');
}
$conn->close();
if(file_exists("libs/conn.php")) {
unlink("libs/conn.php");
touch("libs/conn.php");
} else {
touch("libs/conn.php");
}

$conn2 = new mysqli($mysqlserv, $mysqlusr, $mysqlpass, "ali_waf");
$conn2->query("SET CHARACTER SET 'utf8'");
$conn2->query("SET NAMES 'utf8'");
if ($conn2->connect_error) {
die('<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>MySQL Kurulumu | HATA</b>
<hr></hr>
<code>
'.$conn->connect_error.'<br>
</code><br>
<div class="form-group">
<br><br><a href="install.php?git=sql_install" " class="btn btn-dark">Tekrar Dene</button><br>
</div></div></div></body>');
}
$tab1 = "CREATE TABLE `admin_bilgi` (
  `id` int(11) NOT NULL,
  `kadi` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `passwd` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `admin_yetki` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;";

$tab2 = "CREATE TABLE `guard_watch` (
  `kural_id` int(11) NOT NULL,
  `kural_adi` varchar(255) CHARACTER SET utf32 COLLATE utf32_turkish_ci NOT NULL,
  `kural_hakkinda` varchar(255) CHARACTER SET utf32 COLLATE utf32_turkish_ci NOT NULL,
  `kural_icerik` text CHARACTER SET utf32 COLLATE utf32_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;";

$tab3 = "CREATE TABLE `ip_ban` (
  `ip_id` int(11) NOT NULL,
  `ip_adresi` varchar(255) NOT NULL,
  `ip_usragent` text NOT NULL,
  `ip_suresi` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";

$tab4 = "CREATE TABLE `method_blok` (
  `method_id` int(11) NOT NULL,
  `method_adi` varchar(255) NOT NULL,
  `method_bilgisi` varchar(255) NOT NULL,
  `method_turu` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;";

$tab5 = "CREATE TABLE `waf_ayar` (
  `ayar_id` int(11) NOT NULL,
  `ayar_adi` text COLLATE utf8_turkish_ci NOT NULL,
  `waf_aktif` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_aktif` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `oto_ban` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `anti_ddos` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `debug` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;";

$alter1 = "ALTER TABLE `admin_bilgi`
  ADD PRIMARY KEY (`id`);";
$alter2 = "ALTER TABLE `guard_watch`
  ADD PRIMARY KEY (`kural_id`);";
$alter3 = "ALTER TABLE `ip_ban`
  ADD PRIMARY KEY (`ip_id`);";
$alter4 = "ALTER TABLE `method_blok`
  ADD PRIMARY KEY (`method_id`);";
$alter5 = "ALTER TABLE `waf_ayar`
  ADD PRIMARY KEY (`ayar_id`);";

$alters1 = "ALTER TABLE `guard_watch`
  MODIFY `kural_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;";
$alters2 = "ALTER TABLE `ip_ban`
  MODIFY `ip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;";
$alters3 = "ALTER TABLE `method_blok`
  MODIFY `method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;";
$alters4 = "ALTER TABLE `waf_ayar`
  MODIFY `ayar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;";


$insert1 = "INSERT INTO `admin_bilgi` (`id`, `kadi`, `passwd`, `email`, `token`, `admin_yetki`) VALUES
(1, 'admin', '060323f33140b4a86b53d01d726a45c7584a3a2b', 'xxx@xxx.com', '060323f33140b4a86b53d01d726a45c7584a3a2b', '0');";
$insert2 = "INSERT INTO `guard_watch` (`kural_id`, `kural_adi`, `kural_hakkinda`, `kural_icerik`) VALUES
(1, 'SQL Engelleme', '', '..¿¿½¿¿%¿¿OR¿¿\"¿¿\'¿¿`¿¿concat¿¿join¿¿\\\"¿¿\\\\¿¿script¿¿alert¿¿JaVaScRiPT¿¿\"¿¿fromCharCode¿¿onmouseover¿¿&#¿¿#&¿¿	¿¿!¿¿#¿¿$¿¿%¿¿(¿¿)¿¿*¿¿~¿¿+¿¿-¿¿_¿¿,¿¿:¿¿;¿¿@[¿¿/¿¿|¿¿\\¿¿]¿¿^¿¿`¿¿//¿¿/¿¿livescript¿¿constructor¿¿:¿¿\'\\ja\\vasc\\ript:alert¿¿¾¿¿¢¿¿order¿¿by¿¿union¿¿table_name¿¿column_name¿¿from¿¿concat¿¿and¿¿AND¿¿limit¿¿SRC¿¿src¿¿meta¿¿embed¿¿xml¿¿XML¿¿x;¿¿x27;¿¿quot¿¿+¿¿UNION¿¿-¿¿-¿¿+¿¿*¿¿’¿¿|¿¿\"¿¿?¿¿₺¿¿@¿¿,¿¿/¿¿“¿¿€¿¿£¿¿$¿¿~¿¿\\¿¿[¿¿]¿¿{¿¿}¿¿>¿¿<¿¿'),
(2, 'RFI Engelleme', 'RFI Engelleme', '//¿¿etc¿¿passwd¿¿conf¿¿MYD¿¿MYI¿¿ini¿¿{¿¿}¿¿/¿¿#¿¿[¿¿]¿¿&#37;¿¿@¿¿¢¿¿¤¿¿¥¿¿¦¿¿§¿¿©¿¿ª¿¿«¿¿¬¿¿&shy;¿¿®¿¿¯¿¿°¿¿±¿¿²¿¿³¿¿µ¿¿¶¿¿·¿¿¸¿¿¹¿¿º¿¿¼¿¿¾¿¿À¿¿exec¿¿%¿¿unhex¿¿ CONVERT¿¿CONCAT_WS¿¿CHAR¿¿InfORmaTion_scHema¿¿WHERE¿¿hex¿¿%20¿¿AND¿¿substring¿¿version¿¿ascii¿¿SLEEP¿¿md5¿¿%0C¿¿%A0¿¿MID¿¿LIKE¿¿');";
$insert3 = "INSERT INTO `method_blok` (`method_id`, `method_adi`, `method_bilgisi`, `method_turu`) VALUES
(2, 'POST', 'POST', 'POST'),
(3, 'GET', '', 'GET');";
$insert4 = "INSERT INTO `waf_ayar` (`ayar_id`, `ayar_adi`, `waf_aktif`, `ayar_aktif`, `oto_ban`, `anti_ddos`, `debug`) VALUES
(1, 'Yeni', '1', '1', '0', '1', '1');";

if ($conn2->query($tab1) === TRUE) {
} else {
die('<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>MySQL Kurulumu | HATA</b>
<hr></hr>
<code>
'.$conn2->error.'<br>
</code><br>
<div class="form-group">
<br><br><a href="install.php?git=sql_install" " class="btn btn-dark">Tekrar Dene</button><br>
</div></div></div></body>');
}

if ($conn2->query($tab2) === TRUE) {
} else {
die('<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>MySQL Kurulumu | HATA</b>
<hr></hr>
<code>
'.$conn2->error.'<br>
</code><br>
<div class="form-group">
<br><br><a href="install.php?git=sql_install" " class="btn btn-dark">Tekrar Dene</button><br>
</div></div></div></body>');
}

if ($conn2->query($tab3) === TRUE) {
} else {
die('<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>MySQL Kurulumu | HATA</b>
<hr></hr>
<code>
'.$conn2->error.'<br>
</code><br>
<div class="form-group">
<br><br><a href="install.php?git=sql_install" " class="btn btn-dark">Tekrar Dene</button><br>
</div></div></div></body>');
}

if ($conn2->query($tab4) === TRUE) {
} else {
die('<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>MySQL Kurulumu | HATA</b>
<hr></hr>
<code>
'.$conn2->error.'<br>
</code><br>
<div class="form-group">
<br><br><a href="install.php?git=sql_install" " class="btn btn-dark">Tekrar Dene</button><br>
</div></div></div></body>');
}

if ($conn2->query($tab5) === TRUE) {
} else {
die('<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>MySQL Kurulumu | HATA</b>
<hr></hr>
<code>
'.$conn2->error.'<br>
</code><br>
<div class="form-group">
<br><br><a href="install.php?git=sql_install" " class="btn btn-dark">Tekrar Dene</button><br>
</div></div></div></body>');
}

if ($conn2->query($alter1) === TRUE) {
} else {
die('<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>MySQL Kurulumu | HATA</b>
<hr></hr>
<code>
'.$conn2->error.'<br>
</code><br>
<div class="form-group">
<br><br><a href="install.php?git=sql_install" " class="btn btn-dark">Tekrar Dene</button><br>
</div></div></div></body>');
}
if ($conn2->query($alter2) === TRUE) {
} else {
die('<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>MySQL Kurulumu | HATA</b>
<hr></hr>
<code>
'.$conn2->error.'<br>
</code><br>
<div class="form-group">
<br><br><a href="install.php?git=sql_install" " class="btn btn-dark">Tekrar Dene</button><br>
</div></div></div></body>');
}
if ($conn2->query($alter3) === TRUE) {
} else {
die('<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>MySQL Kurulumu | HATA</b>
<hr></hr>
<code>
'.$conn2->error.'<br>
</code><br>
<div class="form-group">
<br><br><a href="install.php?git=sql_install" " class="btn btn-dark">Tekrar Dene</button><br>
</div></div></div></body>');
}
if ($conn2->query($alter4) === TRUE) {
} else {
die('<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>MySQL Kurulumu | HATA</b>
<hr></hr>
<code>
'.$conn2->error.'<br>
</code><br>
<div class="form-group">
<br><br><a href="install.php?git=sql_install" " class="btn btn-dark">Tekrar Dene</button><br>
</div></div></div></body>');
}
if ($conn2->query($alter5) === TRUE) {
} else {
die('<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>MySQL Kurulumu | HATA</b>
<hr></hr>
<code>
'.$conn2->error.'<br>
</code><br>
<div class="form-group">
<br><br><a href="install.php?git=sql_install" " class="btn btn-dark">Tekrar Dene</button><br>
</div></div></div></body>');
}


if ($conn2->query($alters1) === TRUE) {
} else {
die('<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>MySQL Kurulumu | HATA</b>
<hr></hr>
<code>
'.$conn2->error.'<br>
</code><br>
<div class="form-group">
<br><br><a href="install.php?git=sql_install" " class="btn btn-dark">Tekrar Dene</button><br>
</div></div></div></body>');
}
if ($conn2->query($alters2) === TRUE) {
} else {
die('<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>MySQL Kurulumu | HATA</b>
<hr></hr>
<code>
'.$conn2->error.'<br>
</code><br>
<div class="form-group">
<br><br><a href="install.php?git=sql_install" " class="btn btn-dark">Tekrar Dene</button><br>
</div></div></div></body>');
}
if ($conn2->query($alters3) === TRUE) {
} else {
die('<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>MySQL Kurulumu | HATA</b>
<hr></hr>
<code>
'.$conn2->error.'<br>
</code><br>
<div class="form-group">
<br><br><a href="install.php?git=sql_install" " class="btn btn-dark">Tekrar Dene</button><br>
</div></div></div></body>');
}
if ($conn2->query($alters4) === TRUE) {
} else {
die('<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>MySQL Kurulumu | HATA</b>
<hr></hr>
<code>
'.$conn2->error.'<br>
</code><br>
<div class="form-group">
<br><br><a href="install.php?git=sql_install" " class="btn btn-dark">Tekrar Dene</button><br>
</div></div></div></body>');
}

if ($conn2->query($insert1) === TRUE) {
} else {
die('<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>MySQL Kurulumu | HATA</b>
<hr></hr>
<code>
'.$conn2->error.'<br>
</code><br>
<div class="form-group">
<br><br><a href="install.php?git=sql_install" " class="btn btn-dark">Tekrar Dene</button><br>
</div></div></div></body>');
}

if ($conn2->query($insert2) === TRUE) {
} else {
die('<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>MySQL Kurulumu | HATA</b>
<hr></hr>
<code>
'.$conn2->error.'<br>
</code><br>
<div class="form-group">
<br><br><a href="install.php?git=sql_install" " class="btn btn-dark">Tekrar Dene</button><br>
</div></div></div></body>');
}

if ($conn2->query($insert3) === TRUE) {
} else {
die('<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>MySQL Kurulumu | HATA</b>
<hr></hr>
<code>
'.$conn2->error.'<br>
</code><br>
<div class="form-group">
<br><br><a href="install.php?git=sql_install" " class="btn btn-dark">Tekrar Dene</button><br>
</div></div></div></body>');
}

if ($conn2->query($insert4) === TRUE) {
} else {
die('<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>MySQL Kurulumu | HATA</b>
<hr></hr>
<code>
'.$conn2->error.'<br>
</code><br>
<div class="form-group">
<br><br><a href="install.php?git=sql_install" " class="btn btn-dark">Tekrar Dene</button><br>
</div></div></div></body>');
}
$conn2->close();

$txt = '$ip = "'.strip_tags($mysqlserv).'"; //host
$user = "'.strip_tags($mysqlusr).'";  // host id
$password = "'.strip_tags($mysqlpass).'";  // password local olduğu için varsayılan şifre
$dbad = "ali_waf"; // db adı ';

echo '<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>MySQL Kurulumu</b>
<hr></hr>
<p> MySQL Başarıyla Kuruldu </p><br>
<b>NOT : <i>index.php DB Bağlantılarını</i> düzenlemeyi unutmayın</b><br><br>
<pre>
'.$txt.'
</pre>
<div class="form-group">
<br><br><a href="install.php?git=install2" " class="btn btn-dark">İleri / Next</button><br>
</div></div></div></body>';
break;


case 'install2':
if(file_exists("yukle.lock")) {
unlink("yukle.lock");
$txt = md5(rand(5,15));
$fp = fopen("yukle.lock","a");
fwrite($fp,$txt);
fclose($fp);
} else {
$txt = md5(rand(5,15));
$fp = fopen("yukle.lock","a");
fwrite($fp,$txt);
fclose($fp);
}
if(file_exists("ali_waf.sql")) {
unlink("ali_waf.sql");
} else {
}
echo '<body class="container">
<br><br><br>
<div class="mx-auto card">
<div class="card-body">
<b>Yükleme Bildirimi</b>
<hr></hr>
<p>Yükleme Tamamlandı. Artık Server hazır durumdadır.</p><br>
<pre>
Default Username : admin
Default Password : 19742008
</pre>
<br>
<a type="button" href="index.php" class="btn btn-dark">Devam Et</a>
</div></div></body>';
break;

}
?>
