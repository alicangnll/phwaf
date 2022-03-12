<?php
class AliWAF_Block {
    protected $host = "localhost";
    protected $dbname = "ibrahi30_alicangonullu";
    protected $user = "ibrahi30_alicangonullu";
    protected $pass = "iTY-^(yS[#dh";
	protected $aliwaf;

	public function Baglanti() {
		try {
			$this->aliwaf = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
			$this->aliwaf->query("SET CHARACTER SET 'utf8'");
			$this->aliwaf->query("SET NAMES 'utf8'");
		} catch (PDOException $e) {
			die("<b>SQL Sunucusuna Bağlanılamadı : ".$e->getMessage()."</b>");
		}
	}

	public function closeConnection() {
		$this->alwaf = null;
	}

	public function reel_ip() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
        $ip=trim($_SERVER['HTTP_CLIENT_IP']);
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //Proxy den bağlanıyorsa gerçek IP yi alır.

    {
        $ip = trim($_SERVER['HTTP_X_FORWARDED_FOR']);
    }
   elseif (!empty($_SERVER['HTTP_X_FORWARDED'])) //Proxy den bağlanıyorsa gerçek IP yi alır.

    {
        $ip = trim($_SERVER['HTTP_X_FORWARDED']);
    }

   elseif (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) //Proxy den bağlanıyorsa gerçek IP yi alır.

    {
        $ip = trim($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']);
    }
	   elseif (!empty($_SERVER['HTTP_FORWARDED'])) //Proxy den bağlanıyorsa gerçek IP yi alır.

    {
        $ip = trim($_SERVER['HTTP_FORWARDED']);
    }
    else
    {
        $ip=trim($_SERVER['REMOTE_ADDR']);
    }
    return $ip;
}

 public function ErrorMessage($type, $method) {
 	die('<!--
 		Author : Ali Can Gönüllü
 		2020-2021
 		Respect !
 		-->
<head><meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" media="screen" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600" />
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
<link rel="stylesheet" media="screen" href="style.css" /></head>
  <body class="background error-page-wrapper background-color background-image">
    <center>
  <div class="content-container shadow">
  <br>
    <div class="head-line secondary-text-color">
	AliWAF | Illegal Girişim Algılandı
    </div>
	<div class="hr"></div>
    <div class="context primary-text-color">
      AliWAF | Illegal Girişim AlgılandıDeneme Türü : '.strip_tags($type).' ('.strip_tags($method).')
    </div>
    <div class="hr"></div>
    <div class="context secondary-text-color">
	<p> Method Türü : '.htmlentities($method).'</p>
      <p>URL : <br>'.strip_tags($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']).'</p>
	  <p>User-Agent : <br>'.strip_tags($_SERVER['HTTP_USER_AGENT']).'</p>
	  <p>IP : <br>'.strip_tags($this->reel_ip()).'</p>
	  <p>Tarih : '.date('d.m.Y H:i:s').'</p>
    </div><br>
    <div class="buttons-container">
      <a class="button" onclick="history.back();" target="_blank"><span class="fa fa-home"></span> Geri Dön</a>
      <a class="button" href="mailto:alicangonullu@yahoo.com" target="_blank"><span class="fa fa-warning"></span> Problem Bildir</a>
    </div></body>');
 }
public function IPError($ad) {
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

public function LogIslem($ad) {
foreach ($ad as $key => $value) {
$json = "".strip_tags($key)."¿".strip_tags($value)."";
$yasakla = explode('¿',$json);
$json2 = var_dump(json_encode($yasakla));
	}
}

public function HeaderIslem() {
$header = apache_request_headers();
foreach ($header as $headers => $value) {
$jsons = ''.strip_tags($headers).'¿?'.strip_tags($value).'';
$yasakla = explode('¿?',$jsons);
$jsonk = var_dump(json_encode($yasakla));
	}
}

public function Debug() {
echo '<pre class="container">';
if($_SERVER['REQUEST_METHOD'] == "GET") {
$getlog = $this->LogIslem($_GET);
echo '<br>';
$gethead = $this->HeaderIslem();
} elseif($_SERVER['REQUEST_METHOD'] == "POST")
{
$getpost = $this->LogIslem($_POST);
echo '<br>';
$gethead = $this->HeaderIslem();
} else {
$getpost = $this->LogIslem($_SERVER['REQUEST_METHOD']);
echo '<br>';
$gethead = $this->HeaderIslem();
}
echo '</pre>';
}

public function memlimit($limit, $type) {
	ini_set('memory_limit',''.$limit.''.$type.'');
}

public function kisalt($metin, $uzunluk){
$metin = substr($metin, 0, $uzunluk)."...";
$metin_son = strrchr($metin, " ");
$metin = str_replace($metin_son," ...", $metin);
return $metin;
}

public function prepareDB_OtobanDurum() {
	$stmt = $this->aliwaf->query("SELECT * FROM waf_ayar ORDER BY ayar_id");
	if($stmt->rowCount()) {
		while($row = $stmt->fetch()){
			if($row["oto_ban"] == "1") {
				return true;
			} else {
				return false;
			}
		}
	}
}

public function prepareDB_KontrolAyar() {
	$stmt = $this->aliwaf->query("SELECT * FROM waf_ayar ORDER BY ayar_id");
	if($stmt->rowCount()) {
		while($row = $stmt->fetch()){
			if($row["ayar_aktif"] == "1") {
				return true;
			} else {
				return false;
			}
		}
	}
}

public function prepareDB_WAFDurum() {
	$stmt = $this->aliwaf->query("SELECT * FROM waf_ayar ORDER BY ayar_id");
	if($stmt->rowCount()) {
		while($row = $stmt->fetch()){
			if($row["waf_aktif"] == "1") {
				return true;
			} else {
				return false;
			}
		}
	}
}

public function prepareDB_DebugDurum() {
	$stmt = $this->aliwaf->query("SELECT * FROM waf_ayar ORDER BY ayar_id");
	if($stmt->rowCount()) {
		while($row = $stmt->fetch()){
			if($row["debug"] == "1") {
				return true;
			} else {
				return false;
			}
		}
	}
}

public function insertDB_LogGiris($ad, $url, $header) {
  $update = $this->aliwaf->prepare("INSERT INTO vuln_log(vuln_name, vuln_ip, vuln_url, vuln_header, vuln_date) VALUES (:ad, :ip, :url, :header, :dte) ");
  $update->bindValue(':ad', strip_tags($ad));
  $update->bindValue(':ip', strip_tags($this->reel_ip()));
  $update->bindValue(':url', htmlentities($url));
  $update->bindValue(':header', $header);
  $update->bindValue(':dte', date("Y/m/d H:i:s"));
  $update->execute();
  if($rowz = $update->rowCount()) {
  } else {
  }
}

public function prepareDB_IPBan($ip) {
	$stmt = $this->aliwaf->query("SELECT * FROM ip_ban WHERE ip_adresi = ".$this->aliwaf->quote($ip)."");
	if($row = $stmt->rowCount()) {
		$this->ErrorMessage("IP Ban", strip_tags($ip));
	} else {
		//Normal
	}
}

public function queryDB_KontrolKurali($data) {
	$stmt = $this->aliwaf->query('SELECT * FROM guard_watch ORDER BY kural_id');
	while($row = $stmt->fetch()){
		$parametreler = strtolower(urldecode($data));
		$parametreler0 = str_replace("#", "", $parametreler);
		$parametreler1 = str_replace("!", "", $parametreler0);
		$parametreler2 = str_replace("=", "", $parametreler1);
		$parametreler3 = str_replace("&", "", $parametreler2);
		$parametreler4 = str_replace("-", "", $parametreler3);
		$parametreler5 = str_replace(":", "", $parametreler4);
		$parametreler6 = str_replace("_", "", $parametreler5);
		$parametreler7 = str_replace("@", "", $parametreler6);
		$parametreler71 = str_replace("/", "", $parametreler7);
		$parametreler72 = str_replace("+", "", $parametreler71);
		$parametreler73 = str_replace("-", "", $parametreler72);
		$parametreler74 = str_replace("[", "", $parametreler73);
		$parametreler75 = str_replace("]", "", $parametreler74);
		$parametreler8 = str_replace(",", "", $parametreler75);
		$yasaklar=$row['kural_icerik'];
		$yasakla=explode('¿¿',$yasaklar);
		$sayiver=substr_count($yasaklar,'¿¿');
		$i=0;
		while ($i<=$sayiver) {
			if (strstr($parametreler8,$yasakla[$i])) {
				$this->insertDB_LogGiris("Injection Error", $parametreler, "");
				$this->ErrorMessage("Injection Error ", htmlentities("Type : ".$this->kisalt($parametreler, 50)." | ".$row['kural_adi'].""));
				if($this->prepareDB_OtobanDurum()  == true){
					$this->prepareDB_IPBan($this->reel_ip());
				} else {
					die();
				}
			}
			$i++;
		}
	}
}

public function queryDB_IPKontrol($ip) {
	$stmt = $this->aliwaf->query("SELECT * FROM ip_ban WHERE ip_adresi = ".$this->aliwaf->quote($ip)."");
	if($row = $stmt->rowCount()) {
		header($_SERVER["SERVER_PROTOCOL"]." 405 Method Not Allowed", true, 405);
		$this->insertDB_LogGiris("IP Error", $_SERVER["SERVER_PROTOCOL"], "");
		$this->ErrorMessage('IP Error', strip_tags($this->reel_ip()));
	} else {

	}
}
public function queryDB_MethodKontrol($method) {
	$stmt = $this->aliwaf->query("SELECT * FROM method_blok WHERE method_turu = ".$this->aliwaf->quote($method)."");
	if($row = $stmt->rowCount()) {
		
	} else {
		header($_SERVER["SERVER_PROTOCOL"]." 405 Method Not Allowed", true, 405);
		$this->insertDB_LogGiris("Method Error", $_SERVER["SERVER_PROTOCOL"], "");
		$this->ErrorMessage('Method Error', strip_tags($this->reel_ip()));
		if($this->prepareDB_OtobanDurum()  == true){
			$this->prepareDB_IPBan($this->reel_ip());
		} else {
			die();
		}
	}
}

}
