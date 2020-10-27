<?php
ob_start();
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
function reel_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //Proxy den bağlanıyorsa gerçek IP yi alır.

    {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
   elseif (!empty($_SERVER['HTTP_X_FORWARDED'])) //Proxy den bağlanıyorsa gerçek IP yi alır.

    {
        $ip = $_SERVER['HTTP_X_FORWARDED'];
    }

   elseif (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) //Proxy den bağlanıyorsa gerçek IP yi alır.

    {
        $ip = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    }
	   elseif (!empty($_SERVER['HTTP_FORWARDED'])) //Proxy den bağlanıyorsa gerçek IP yi alır.

    {
        $ip = $_SERVER['HTTP_FORWARDED'];
    }
    else
    {
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function IPError($ad) {
if(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2) == "tr") {
echo '<br><div class="context secondary-text-color">
<p>IP Adresiniz '.strip_tags($ad).' Saat Banlandı.</p>
</div>';
} else {
echo '<br><div class="context secondary-text-color">
<p>IP Adress : '.strip_tags($ad).' Banned from Web Server for One Hour.</p>
</div>';
}
}

function LogIslem($ad) {
foreach ($ad as $key => $value) {
$json = "".strip_tags($key)."¿".strip_tags($value)."";
$yasakla = explode('¿',$json);
$json2 = var_dump(json_encode($yasakla));
	}
}

function HeaderIslem() {
$header = apache_request_headers();
foreach ($header as $headers => $value) {
$jsons = ''.strip_tags($headers).'¿?'.strip_tags($value).'';
$yasakla = explode('¿?',$jsons);
$jsonk = var_dump(json_encode($yasakla));
	}
}

function Debug() {
echo '<pre class="container">';
if($_SERVER['REQUEST_METHOD'] == "GET") {
$getlog = LogIslem($_GET);
echo '<br>';
$gethead = HeaderIslem();
} elseif($_SERVER['REQUEST_METHOD'] == "POST")
{
$getpost = LogIslem($_POST);
echo '<br>';
$gethead = HeaderIslem();
} else {
$getpost = LogIslem($_SERVER['REQUEST_METHOD']);
echo '<br>';
$gethead = HeaderIslem();
}
echo '</pre>';
}

function kisalt($metin, $uzunluk){
$metin = substr($metin, 0, $uzunluk)."...";
$metin_son = strrchr($metin, " ");
$metin = str_replace($metin_son," ...", $metin);
return $metin;
}
// IP Engelleme
try {
$ip = "localhost"; //host
$user = "root";  // host id
$password = "19742008";  // password local olduğu için varsayılan şifre
$dbad = "ali_waf"; // db adı

     $db = new PDO("mysql:host=$ip;dbname=$dbad", "$user", "$password");
     $db->query("SET CHARACTER SET 'utf8'");
     $db->query("SET NAMES 'utf8'");

} catch ( PDOException $e ){
     echo '
	 <table>
<center><img src="veri/sql.png" alt="Örnek Resim"/></center>
<center>No MySQL Connection</center>
<center>Bunun Sebebi Bir DDoS Saldırısı Olabilir</center>
<center>Sistem Yöneticinizle Irtibata Geçin</center>
	 </table>';
	 die();
}

try {

$stmt = $db->query("SELECT * FROM waf_ayar ORDER BY ayar_id");
if($stmt->rowCount()) {
while($row = $stmt->fetch()){
session_start();
$ayaraktif = md5(sha1($row["ayar_aktif"]));
$otoban = md5(sha1($row["oto_ban"]));
$ipadres = reel_ip();
$wafdurum = md5(sha1($row["waf_aktif"]));
$debug = md5(sha1($row["debug"]));
if (md5(sha1($row["ayar_aktif"])) == md5(sha1(1))){
header('X-AliWAF: ACTIVE');
} else {
header('X-AliWAF: DEACTIVE');
}
   }
		}
		    } catch(PDOException $e) {
}

if ($debug == md5(sha1(1))){
Debug();
} else {
}

$ip = reel_ip();
$stmt = $db->query("SELECT * FROM ip_ban WHERE ip_adresi = ".$db->quote($ip)."");
if($stmt->rowCount()) {
while($row = $stmt->fetch()){
session_start();
$_SESSION['suresi'] = strip_tags($row["ip_suresi"]);
	if ($wafdurum == md5(sha1(1))){
		if ($_SESSION['suresi'] - date('H:i:s') >= 30){

		} else {
?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" media="screen" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600" />
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />


    <style>
     * {
         -moz-box-sizing:border-box;
         -webkit-box-sizing:border-box;
         box-sizing:border-box;
     }

     html, body, div, span, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre,
     abbr, address, cite, code, del, dfn, em, img, ins, kbd, q, samp,
     small, strong, sub, sup, var, b, i, dl, dt, dd, ol, ul, li,
     fieldset, form, label, legend, caption, article, aside, canvas, details, figcaption, figure,  footer, header, hgroup,
     menu, nav, section, summary, time, mark, audio, video {
         margin:0;
         padding:0;
         border:0;
         outline:0;
         vertical-align:baseline;
         background:transparent;
     }

     article, aside, details, figcaption, figure, footer, header, hgroup, nav, section {
         display: block;
     }

     html {
         font-size: 16px;
         line-height: 24px;
         width:100%;
         height:100%;
         -webkit-text-size-adjust: 100%;
         -ms-text-size-adjust: 100%;
         overflow-y:scroll;
         overflow-x:hidden;
     }

     img {
         vertical-align:middle;
         max-width: 100%;
         height: auto;
         border: 0;
         -ms-interpolation-mode: bicubic;
     }

     body {
         min-height:100%;
         -webkit-font-smoothing: subpixel-antialiased;
     }

     .clearfix {
	       clear:both;
	       zoom: 1;
     }
     .clearfix:before, .clearfix:after {
         content: "\0020";
         display: block;
         height: 0;
         visibility: hidden;
     }
     .clearfix:after {
         clear: both;
     }
  body.background.error-page-wrapper, .background.error-page-wrapper.preview {
    font-family: 'Source Sans Pro', sans-serif;
    background-position:center center;
    background-repeat:no-repeat;
    background-size:cover;
    position:relative;
  }

  .background.error-page-wrapper .content-container {
    border-radius: 6px;
    text-align: center;
    box-shadow: 0 0 20px rgba(0,0,0,.2);
    padding:50px;
    background-color: #fff;
    width:100%;
    max-width:525px;
    position:absolute;
    left:50%;
    margin-left:-262px;
  }

  .background.error-page-wrapper .content-container.in {
    left:0px;
    opacity:1;
  }

  .background.error-page-wrapper .head-line {
    transition:color .2s linear;
    font-size:48px;
    line-height:60px;
    letter-spacing: -1px;
    margin-bottom: 5px;
    color:#ccc;
  }
  .background.error-page-wrapper .subheader {
    transition:color .2s linear;
    font-size:36px;
    line-height:46px;
    color:#333;
  }
  .background.error-page-wrapper .hr {
    height:1px;
    background-color: #ddd;
    width:60%;
    max-width:250px;
    margin:35px auto;
  }
  .background.error-page-wrapper .context {
    transition:color .2s linear;
    font-size:18px;
    line-height:27px;
    color:#bbb;
  }
  .background.error-page-wrapper .context p {
    margin:0;
  }
  .background.error-page-wrapper .context p:nth-child(n+2) {
    margin-top:16px;
  }
  .background.error-page-wrapper .buttons-container {
    margin-top: 35px;
    overflow: hidden;
  }
  .background.error-page-wrapper .buttons-container a {
    transition:text-indent .2s ease-out, color .2s linear, background-color .2s linear;
    text-indent: 0px;
    font-size:14px;
    text-transform: uppercase;
    text-decoration: none;
    color:#fff;
    background-color:#2ecc71;
    border-radius: 99px;
    padding:12px 0 13px;
    text-align: center;
    display:inline-block;
    overflow: hidden;
    position: relative;
    width:45%;
  }

  .background.error-page-wrapper .buttons-container .fa {
    transition:left .2s ease-out;
    position: absolute;
    left:-50px;
  }

  .background.error-page-wrapper .buttons-container a:hover {
    text-indent: 15px;
  }

  .background.error-page-wrapper .buttons-container a:nth-child(1) {
    float:left;
  }

  .background.error-page-wrapper .buttons-container a:nth-child(2) {
    float:right;
  }

  .background.error-page-wrapper .buttons-container .fa-home {
    font-size:18px;
    top:15px;
  }

  .background.error-page-wrapper .buttons-container a:hover .fa-home {
    left:10px;
  }

  .background.error-page-wrapper .buttons-container .fa-warning {
    font-size:16px;
    top:17px;
  }

  .background.error-page-wrapper .buttons-container a:hover .fa-warning {
    left:5px;
  }

  .background.error-page-wrapper .buttons-container .fa-power-off {
    font-size:16px;
    top:17px;
  }

  .background.error-page-wrapper .buttons-container a:hover .fa-power-off {
    left:9px;
  }


  .background.error-page-wrapper .buttons-container.single-button {
    text-align: center;
  }

  .background.error-page-wrapper .buttons-container.single-button a  {
    float:none !important;
  }

  @media screen and (max-width: 555px) {
    .background.error-page-wrapper {
      padding:30px 5%;
    }
    .background.error-page-wrapper .content-container {
      padding:37px;
      position: static;
      left: 0;
      margin-left:0;
    }
    .background.error-page-wrapper .head-line {
      font-size:36px;
    }
    .background.error-page-wrapper .subheader {
      font-size:27px;
      line-height: 37px;
    }
    .background.error-page-wrapper .hr {
      margin:30px auto;
      width:215px;
    }
    .background.error-page-wrapper .buttons-container .fa {
      display:none;
    }
    .background.error-page-wrapper .buttons-container a:hover {
      text-indent: 0px;
    }
  }

  @media screen and (max-width: 450px) {
    .background.error-page-wrapper {
      padding:30px;
    }
    .background.error-page-wrapper .head-line {
      font-size:32px;
    }
    .background.error-page-wrapper .hr {
      margin:25px auto;
      width:180px;
    }
    .background.error-page-wrapper .context {
      font-size:15px;
      line-height:22px;
    }

    .background.error-page-wrapper .context p:nth-child(n+2) {
      margin-top:10px;
    }
    .background.error-page-wrapper .buttons-container {
      margin-top:29px;
    }
    .background.error-page-wrapper .buttons-container a {
      float:none !important;
      width:65%;
      margin:0 auto;
      font-size:13px;
      padding:9px 0;
    }

    .background.error-page-wrapper .buttons-container a:nth-child(2) {
      margin-top:12px;
    }
  }

    .background-image {
      background-color: #FFFFFF;
      background-image: url(https://archive.is/QjJ75/e499aa8e2369ac30ebfee0d75f41c75665d61b03) !important;
    }

    .primary-text-color {
      color: rgba(107, 94, 94, 1) !important;
    }

    .secondary-text-color {
      color: #AAAAAA !important;
    }




    .border-button {
      color: rgba(255, 0, 0, 1) !important;
      border-color: rgba(255, 0, 0, 1) !important;
    }
    .button {
      background-color: rgba(255, 0, 0, 1) !important;
      color: rgba(255, 255, 255, 1) !important;
    }

    .shadow {
      box-shadow: 0 0 30px #000000;
    }

</style>
  <body class="background error-page-wrapper background-color background-image">
    <center>
  <div class="content-container shadow">
  <br>
    <div class="head-line secondary-text-color">
		Illegal Girişim Algılandı | IP Ban
    </div>
	<div class="hr"></div>
    <div class="context primary-text-color">
      Deneme Türü : IP Adresiniz Banlı (<?php echo strip_tags($ip); ?>)
    </div>
    <div class="hr"></div>
    <div class="context secondary-text-color">
	<p>IP Adresi : <?php echo strip_tags($ip); ?></p>
      <p>URL : <br><?php echo strip_tags($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']); ?></p>
	  <p>User-Agent : <br><?php echo strip_tags($_SERVER['HTTP_USER_AGENT']); ?></p>
	  <p>Tarih : <?php echo date('d.m.Y H:i:s'); ?></p>
    </div>
    <div class="buttons-container">
      <a class="button" onclick="history.back();" target="_blank"><span class="fa fa-home"></span> Geri Dön</a>
      <a class="button" href="mailto:alicangonullu@yahoo.com" target="_blank"><span class="fa fa-warning"></span> Problem Bildir</a>
    </div>
  </div>
</center>
</body>
<?php
					echo '
		<p align="center">IP Ban Listesindesiniz</p><br>
		<p align="center"> IP Adresin <b>'.strip_tags($ip).'</b>';
		die();
		}
	} else {
		header('X-AliWAF: DEACTIVE');
	}
   }
}
if ($ayaraktif == md5(sha1(1))){

$stmt = $db->query('SELECT * FROM guard_watch ORDER BY kural_id');
	while($row = $stmt->fetch()){
		$parametreler = strtolower($_SERVER['QUERY_STRING']);
		$yasaklar=($row['kural_icerik']);
		$yasakla=explode('¿¿',$yasaklar);
$sayiver=substr_count($yasaklar,'¿¿');
$i=0;
while ($i<=$sayiver) {
if (strstr($parametreler,$yasakla[$i])) {
if ($ayaraktif == md5(sha1(1))){
?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" media="screen" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600" />
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />


    <style>
     * {
         -moz-box-sizing:border-box;
         -webkit-box-sizing:border-box;
         box-sizing:border-box;
     }

     html, body, div, span, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre,
     abbr, address, cite, code, del, dfn, em, img, ins, kbd, q, samp,
     small, strong, sub, sup, var, b, i, dl, dt, dd, ol, ul, li,
     fieldset, form, label, legend, caption, article, aside, canvas, details, figcaption, figure,  footer, header, hgroup,
     menu, nav, section, summary, time, mark, audio, video {
         margin:0;
         padding:0;
         border:0;
         outline:0;
         vertical-align:baseline;
         background:transparent;
     }

     article, aside, details, figcaption, figure, footer, header, hgroup, nav, section {
         display: block;
     }

     html {
         font-size: 16px;
         line-height: 24px;
         width:100%;
         height:100%;
         -webkit-text-size-adjust: 100%;
         -ms-text-size-adjust: 100%;
         overflow-y:scroll;
         overflow-x:hidden;
     }

     img {
         vertical-align:middle;
         max-width: 100%;
         height: auto;
         border: 0;
         -ms-interpolation-mode: bicubic;
     }

     body {
         min-height:100%;
         -webkit-font-smoothing: subpixel-antialiased;
     }

     .clearfix {
	       clear:both;
	       zoom: 1;
     }
     .clearfix:before, .clearfix:after {
         content: "\0020";
         display: block;
         height: 0;
         visibility: hidden;
     }
     .clearfix:after {
         clear: both;
     }
    </style>
    <style>
  body.background.error-page-wrapper, .background.error-page-wrapper.preview {
    font-family: 'Source Sans Pro', sans-serif;
    background-position:center center;
    background-repeat:no-repeat;
    background-size:cover;
    position:relative;
  }

  .background.error-page-wrapper .content-container {
    border-radius: 6px;
    text-align: center;
    box-shadow: 0 0 20px rgba(0,0,0,.2);
    padding:50px;
    background-color: #fff;
    width:100%;
    max-width:525px;
    position:absolute;
    left:50%;
    margin-left:-262px;
  }

  .background.error-page-wrapper .content-container.in {
    left:0px;
    opacity:1;
  }

  .background.error-page-wrapper .head-line {
    transition:color .2s linear;
    font-size:48px;
    line-height:60px;
    letter-spacing: -1px;
    margin-bottom: 5px;
    color:#ccc;
  }
  .background.error-page-wrapper .subheader {
    transition:color .2s linear;
    font-size:36px;
    line-height:46px;
    color:#333;
  }
  .background.error-page-wrapper .hr {
    height:1px;
    background-color: #ddd;
    width:60%;
    max-width:250px;
    margin:35px auto;
  }
  .background.error-page-wrapper .context {
    transition:color .2s linear;
    font-size:18px;
    line-height:27px;
    color:#bbb;
  }
  .background.error-page-wrapper .context p {
    margin:0;
  }
  .background.error-page-wrapper .context p:nth-child(n+2) {
    margin-top:16px;
  }
  .background.error-page-wrapper .buttons-container {
    margin-top: 35px;
    overflow: hidden;
  }
  .background.error-page-wrapper .buttons-container a {
    transition:text-indent .2s ease-out, color .2s linear, background-color .2s linear;
    text-indent: 0px;
    font-size:14px;
    text-transform: uppercase;
    text-decoration: none;
    color:#fff;
    background-color:#2ecc71;
    border-radius: 99px;
    padding:12px 0 13px;
    text-align: center;
    display:inline-block;
    overflow: hidden;
    position: relative;
    width:45%;
  }

  .background.error-page-wrapper .buttons-container .fa {
    transition:left .2s ease-out;
    position: absolute;
    left:-50px;
  }

  .background.error-page-wrapper .buttons-container a:hover {
    text-indent: 15px;
  }

  .background.error-page-wrapper .buttons-container a:nth-child(1) {
    float:left;
  }

  .background.error-page-wrapper .buttons-container a:nth-child(2) {
    float:right;
  }

  .background.error-page-wrapper .buttons-container .fa-home {
    font-size:18px;
    top:15px;
  }

  .background.error-page-wrapper .buttons-container a:hover .fa-home {
    left:10px;
  }

  .background.error-page-wrapper .buttons-container .fa-warning {
    font-size:16px;
    top:17px;
  }

  .background.error-page-wrapper .buttons-container a:hover .fa-warning {
    left:5px;
  }

  .background.error-page-wrapper .buttons-container .fa-power-off {
    font-size:16px;
    top:17px;
  }

  .background.error-page-wrapper .buttons-container a:hover .fa-power-off {
    left:9px;
  }


  .background.error-page-wrapper .buttons-container.single-button {
    text-align: center;
  }

  .background.error-page-wrapper .buttons-container.single-button a  {
    float:none !important;
  }

  @media screen and (max-width: 555px) {
    .background.error-page-wrapper {
      padding:30px 5%;
    }
    .background.error-page-wrapper .content-container {
      padding:37px;
      position: static;
      left: 0;
      margin-left:0;
    }
    .background.error-page-wrapper .head-line {
      font-size:36px;
    }
    .background.error-page-wrapper .subheader {
      font-size:27px;
      line-height: 37px;
    }
    .background.error-page-wrapper .hr {
      margin:30px auto;
      width:215px;
    }
    .background.error-page-wrapper .buttons-container .fa {
      display:none;
    }
    .background.error-page-wrapper .buttons-container a:hover {
      text-indent: 0px;
    }
  }

  @media screen and (max-width: 450px) {
    .background.error-page-wrapper {
      padding:30px;
    }
    .background.error-page-wrapper .head-line {
      font-size:32px;
    }
    .background.error-page-wrapper .hr {
      margin:25px auto;
      width:180px;
    }
    .background.error-page-wrapper .context {
      font-size:15px;
      line-height:22px;
    }

    .background.error-page-wrapper .context p:nth-child(n+2) {
      margin-top:10px;
    }
    .background.error-page-wrapper .buttons-container {
      margin-top:29px;
    }
    .background.error-page-wrapper .buttons-container a {
      float:none !important;
      width:65%;
      margin:0 auto;
      font-size:13px;
      padding:9px 0;
    }

    .background.error-page-wrapper .buttons-container a:nth-child(2) {
      margin-top:12px;
    }
  }
</style>

    <style>


    .background-image {
      background-color: #FFFFFF;
      background-image: url(https://archive.is/QjJ75/e499aa8e2369ac30ebfee0d75f41c75665d61b03) !important;
    }

    .primary-text-color {
      color: rgba(107, 94, 94, 1) !important;
    }

    .secondary-text-color {
      color: #AAAAAA !important;
    }




    .border-button {
      color: rgba(255, 0, 0, 1) !important;
      border-color: rgba(255, 0, 0, 1) !important;
    }
    .button {
      background-color: rgba(255, 0, 0, 1) !important;
      color: rgba(255, 255, 255, 1) !important;
    }

    .shadow {
      box-shadow: 0 0 30px #000000;
    }

</style>
  <body class="background error-page-wrapper background-color background-image">
    <center>
  <div class="content-container shadow">
  <br>
    <div class="head-line secondary-text-color">
		Illegal Girişim Algılandı
    </div>
	<div class="hr"></div>
    <div class="context primary-text-color">
      Deneme Türü : <?php echo $row['kural_adi']; ?>
    </div>
    <div class="hr"></div>
    <div class="context secondary-text-color">
      <p>URL : <br><?php echo strip_tags($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']); ?></p>
	  <p>User-Agent : <br><?php echo strip_tags($_SERVER['HTTP_USER_AGENT']); ?></p>
	  <p>Tarih : <?php echo strip_tags(date('d.m.Y H:i:s')); ?></p>
    </div>
    <div class="buttons-container">
      <a class="button" onclick="history.back();" target="_blank"><span class="fa fa-home"></span> Geri Dön</a>
      <a class="button" href="mailto:alicangonullu@yahoo.com" target="_blank"><span class="fa fa-warning"></span> Problem Bildir</a>
    </div>
	<?php
if ($otoban == md5(sha1(1))){
$bandurum = md5(sha1(1));
$update = $db->prepare("INSERT INTO ip_ban(ip_adresi, ip_suresi, ip_usragent) VALUES (:ipadresi, :ipsuresi, :ipusragent) ");
$update->bindValue(':ipadresi', strip_tags($ip));
$update->bindValue(':ipusragent', strip_tags($_SERVER['HTTP_USER_AGENT']));
$update->bindValue(':ipsuresi', date('H:i:s'));
$update->execute();
if($update){
IPError("1");
die();
}
} else {
die();
}
?>
  </div>
</center>
</body>
<?php
} else {
header('X-AliWAF: DEACTIVE');
}
}

$i++;
}
if (strlen($parametreler)>=90) {
exit;
}
	}
	//Guard Bitti
$method = strip_tags($_SERVER['REQUEST_METHOD']);
$stmt = $db->query("SELECT * FROM method_blok WHERE method_turu = ".$db->quote($method)."");
if($stmt->rowCount()) {
while($row = $stmt->fetch()){
   }
		} else
	{

if ($ayaraktif == md5(sha1(1))){
header($_SERVER["SERVER_PROTOCOL"]." 405 Method Not Allowed", true, 405);
?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" media="screen" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600" />
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />


    <style>
     * {
         -moz-box-sizing:border-box;
         -webkit-box-sizing:border-box;
         box-sizing:border-box;
     }

     html, body, div, span, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre,
     abbr, address, cite, code, del, dfn, em, img, ins, kbd, q, samp,
     small, strong, sub, sup, var, b, i, dl, dt, dd, ol, ul, li,
     fieldset, form, label, legend, caption, article, aside, canvas, details, figcaption, figure,  footer, header, hgroup,
     menu, nav, section, summary, time, mark, audio, video {
         margin:0;
         padding:0;
         border:0;
         outline:0;
         vertical-align:baseline;
         background:transparent;
     }

     article, aside, details, figcaption, figure, footer, header, hgroup, nav, section {
         display: block;
     }

     html {
         font-size: 16px;
         line-height: 24px;
         width:100%;
         height:100%;
         -webkit-text-size-adjust: 100%;
         -ms-text-size-adjust: 100%;
         overflow-y:scroll;
         overflow-x:hidden;
     }

     img {
         vertical-align:middle;
         max-width: 100%;
         height: auto;
         border: 0;
         -ms-interpolation-mode: bicubic;
     }

     body {
         min-height:100%;
         -webkit-font-smoothing: subpixel-antialiased;
     }

     .clearfix {
	       clear:both;
	       zoom: 1;
     }
     .clearfix:before, .clearfix:after {
         content: "\0020";
         display: block;
         height: 0;
         visibility: hidden;
     }
     .clearfix:after {
         clear: both;
     }
    </style>
    <style>
  body.background.error-page-wrapper, .background.error-page-wrapper.preview {
    font-family: 'Source Sans Pro', sans-serif;
    background-position:center center;
    background-repeat:no-repeat;
    background-size:cover;
    position:relative;
  }

  .background.error-page-wrapper .content-container {
    border-radius: 6px;
    text-align: center;
    box-shadow: 0 0 20px rgba(0,0,0,.2);
    padding:50px;
    background-color: #fff;
    width:100%;
    max-width:525px;
    position:absolute;
    left:50%;
    margin-left:-262px;
  }

  .background.error-page-wrapper .content-container.in {
    left:0px;
    opacity:1;
  }

  .background.error-page-wrapper .head-line {
    transition:color .2s linear;
    font-size:48px;
    line-height:60px;
    letter-spacing: -1px;
    margin-bottom: 5px;
    color:#ccc;
  }
  .background.error-page-wrapper .subheader {
    transition:color .2s linear;
    font-size:36px;
    line-height:46px;
    color:#333;
  }
  .background.error-page-wrapper .hr {
    height:1px;
    background-color: #ddd;
    width:60%;
    max-width:250px;
    margin:35px auto;
  }
  .background.error-page-wrapper .context {
    transition:color .2s linear;
    font-size:18px;
    line-height:27px;
    color:#bbb;
  }
  .background.error-page-wrapper .context p {
    margin:0;
  }
  .background.error-page-wrapper .context p:nth-child(n+2) {
    margin-top:16px;
  }
  .background.error-page-wrapper .buttons-container {
    margin-top: 35px;
    overflow: hidden;
  }
  .background.error-page-wrapper .buttons-container a {
    transition:text-indent .2s ease-out, color .2s linear, background-color .2s linear;
    text-indent: 0px;
    font-size:14px;
    text-transform: uppercase;
    text-decoration: none;
    color:#fff;
    background-color:#2ecc71;
    border-radius: 99px;
    padding:12px 0 13px;
    text-align: center;
    display:inline-block;
    overflow: hidden;
    position: relative;
    width:45%;
  }

  .background.error-page-wrapper .buttons-container .fa {
    transition:left .2s ease-out;
    position: absolute;
    left:-50px;
  }

  .background.error-page-wrapper .buttons-container a:hover {
    text-indent: 15px;
  }

  .background.error-page-wrapper .buttons-container a:nth-child(1) {
    float:left;
  }

  .background.error-page-wrapper .buttons-container a:nth-child(2) {
    float:right;
  }

  .background.error-page-wrapper .buttons-container .fa-home {
    font-size:18px;
    top:15px;
  }

  .background.error-page-wrapper .buttons-container a:hover .fa-home {
    left:10px;
  }

  .background.error-page-wrapper .buttons-container .fa-warning {
    font-size:16px;
    top:17px;
  }

  .background.error-page-wrapper .buttons-container a:hover .fa-warning {
    left:5px;
  }

  .background.error-page-wrapper .buttons-container .fa-power-off {
    font-size:16px;
    top:17px;
  }

  .background.error-page-wrapper .buttons-container a:hover .fa-power-off {
    left:9px;
  }


  .background.error-page-wrapper .buttons-container.single-button {
    text-align: center;
  }

  .background.error-page-wrapper .buttons-container.single-button a  {
    float:none !important;
  }

  @media screen and (max-width: 555px) {
    .background.error-page-wrapper {
      padding:30px 5%;
    }
    .background.error-page-wrapper .content-container {
      padding:37px;
      position: static;
      left: 0;
      margin-left:0;
    }
    .background.error-page-wrapper .head-line {
      font-size:36px;
    }
    .background.error-page-wrapper .subheader {
      font-size:27px;
      line-height: 37px;
    }
    .background.error-page-wrapper .hr {
      margin:30px auto;
      width:215px;
    }
    .background.error-page-wrapper .buttons-container .fa {
      display:none;
    }
    .background.error-page-wrapper .buttons-container a:hover {
      text-indent: 0px;
    }
  }

  @media screen and (max-width: 450px) {
    .background.error-page-wrapper {
      padding:30px;
    }
    .background.error-page-wrapper .head-line {
      font-size:32px;
    }
    .background.error-page-wrapper .hr {
      margin:25px auto;
      width:180px;
    }
    .background.error-page-wrapper .context {
      font-size:15px;
      line-height:22px;
    }

    .background.error-page-wrapper .context p:nth-child(n+2) {
      margin-top:10px;
    }
    .background.error-page-wrapper .buttons-container {
      margin-top:29px;
    }
    .background.error-page-wrapper .buttons-container a {
      float:none !important;
      width:65%;
      margin:0 auto;
      font-size:13px;
      padding:9px 0;
    }

    .background.error-page-wrapper .buttons-container a:nth-child(2) {
      margin-top:12px;
    }
  }
</style>

    <style>


    .background-image {
      background-color: #FFFFFF;
      background-image: url(https://archive.is/QjJ75/e499aa8e2369ac30ebfee0d75f41c75665d61b03) !important;
    }

    .primary-text-color {
      color: rgba(107, 94, 94, 1) !important;
    }

    .secondary-text-color {
      color: #AAAAAA !important;
    }




    .border-button {
      color: rgba(255, 0, 0, 1) !important;
      border-color: rgba(255, 0, 0, 1) !important;
    }
    .button {
      background-color: rgba(255, 0, 0, 1) !important;
      color: rgba(255, 255, 255, 1) !important;
    }

    .shadow {
      box-shadow: 0 0 30px #000000;
    }

</style>
  <body class="background error-page-wrapper background-color background-image">
    <center>
  <div class="content-container shadow">
  <br>
    <div class="head-line secondary-text-color">
		Illegal Girişim Algılandı
    </div>
	<div class="hr"></div>
    <div class="context primary-text-color">
      Deneme Türü : Method Injection (<?php echo strip_tags($method); ?>)
    </div>
    <div class="hr"></div>
    <div class="context secondary-text-color">
	<p> Method Türü : <?php echo strip_tags($method); ?></p>
      <p>URL : <br><?php echo strip_tags($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']); ?></p>
	  <p>User-Agent : <br><?php echo strip_tags($_SERVER['HTTP_USER_AGENT']); ?></p>
	  <p>Tarih : <?php echo date('d.m.Y H:i:s'); ?></p>
    </div>
    <div class="buttons-container">
      <a class="button" onclick="history.back();" target="_blank"><span class="fa fa-home"></span> Geri Dön</a>
      <a class="button" href="mailto:alicangonullu@yahoo.com" target="_blank"><span class="fa fa-warning"></span> Problem Bildir</a>
    </div>
	<?php
if ($otoban == md5(sha1(1))){
$bandurum = md5(sha1(1));
$update = $db->prepare("INSERT INTO ip_ban(ip_adresi, ip_suresi, ip_usragent) VALUES (:ipadresi, :ipsuresi, :ipusragent) ");
$update->bindValue(':ipadresi', strip_tags($ip));
$update->bindValue(':ipusragent', strip_tags($_SERVER['HTTP_USER_AGENT']));
$update->bindValue(':ipsuresi', date('H:i:s'));
$update->execute();
if($update){
IPError("1");
die();
}
} else {
	die();
}
?>
  </div>
</center>
</body>
<?php

} else {
header('X-AliWAF: DEACTIVE');
		}
	}

} else {
	header('X-AliWAF: PENDING');
}
	//Istek Engellendi

?>