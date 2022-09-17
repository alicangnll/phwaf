<?php
ini_set('session.cookie_domain', '.'.$_SERVER["HTTP_HOST"].'');
session_set_cookie_params(0);
session_start();

class AliWAF_Panel {
    protected $host = "localhost";
    protected $dbname = "ali_waf";
    protected $user = "root";
    protected $pass = "";
    protected $aliwafpanel;
    public function __construct() {
		try {
			$this->aliwafpanel = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
			$this->aliwafpanel->query("SET CHARACTER SET 'utf8'");
			$this->aliwafpanel->query("SET NAMES 'utf8'");
		} catch (PDOException $e) {
			die("<b>SQL Sunucusuna Bağlanılamadı : ".$e->getMessage()."</b>");
		}
	}

  private function Captcha_Olustur() {
    if(extension_loaded("gd")) {
      session_start();
      $kod = substr(md5(uniqid(rand(0, 6))), 0, 6);
      $_SESSION['kod'] = $kod;
      header('Content-type: image/png');
      $kod_uzunluk = strlen($kod);
      $genislik = imagefontwidth(5) * $kod_uzunluk;
      $yukseklik = imagefontheight(5);
      $resim = imagecreate($genislik, $yukseklik);
      $arka_renk = imagecolorallocate($resim, 0, 0, 0);
      $yazi_renk = imagecolorallocate($resim, 255, 255, 255);
      imagefill($resim, 0, 0, $arka_renk);
      imagestring($resim, 5, 0, 0, $kod, $yazi_renk);
      imagepng($resim);
    } else {
      $kod = substr(md5(uniqid(rand(0, 6))), 0, 6);
      $_SESSION['kod'] = $kod;
      return base64_encode($kod);
    }
  }

  public function LoginCheck_Captcha($apikey = "") {
    date_default_timezone_set('Europe/Istanbul');
    echo '
    <div class="col-md-12 form-group">';
    if(extension_loaded("gd")) {
    echo '<img src="data:image/png;base64,'.base64_encode($this->Captcha_Olustur()).'" /><br>';
    } else {
      echo '<b>CAPTCHA Kodunuz : '.base64_decode($this->Captcha_Olustur()).'</b>';
    }
    echo '<p>Captcha : <input data-role="input" type="text" name="g-recaptcha-response" placeholder="CAPTCHA"></p>
    </div>';
  }

  public function DB_LoginCheck($usr, $pwd) {
    if($_POST) {
      if($_POST['g-recaptcha-response'] == $_SESSION["kod"]){
      }
      $query  = $this->aliwafpanel->query("SELECT * FROM admin_bilgi WHERE kadi = ".$this->aliwafpanel->quote(strip_tags($usr)) . " && passwd = " . $this->aliwafpanel->quote(strip_tags(sha1(md5($pwd)))) . "",PDO::FETCH_ASSOC);
      if ($say = $query -> rowCount()){
      if( $say > 0 ){
      $date = time() + 1800;
      $_SESSION["girisyap"] = $date;
      echo '<script>document.cookie = "girisyap='.$date.'; expires=Thu, '.date("d").' Dec '.date("Y").' 12:00:00 UTC";window.location.href = "index.php?git=index";</script>';
      }
      }else{
      die('<script>window.location.href = "index.php?git=login";</script>');
      }
      
      } else {
        die('<script>window.location.href = "index.php?git=login";</script>');
      }
  }

  public function KontrolSession() {
    if (isset($_COOKIE['girisyap'])){
      echo '<aside class="sidebar pos-absolute z-2" data-role="sidebar" data-toggle="#sidebar-toggle-3" id="sb3" data-shift=".shifted-content">
      <div class="sidebar-header" data-image="https://metroui.org.ua/images/sb-bg-1.jpg">
      <div class="avatar">
      <img data-role="gravatar" data-email="alicangonullu@yahoo.com">
      </div>
      <span style="background-color: rgb(0,0,0);background-color: rgba(0,0,0, 0.4);width:45%;"  class="title fg-white">Ali Can Gönüllü</span>
      </div>
          <ul class="sidebar-menu">
              <li><a href="index.php?git=index"><span class="mif-home icon"></span>Home</a></li>
              <li><a href="index.php?git=admin"><span class="mif-user icon"></span>Admin</a></li>
              <li><a href="index.php?git=update"><span class="mif-cloud-upload icon"></span>Update</a></li>
              <li><a href="index.php?git=loglar"><span class="mif-file-text icon"></span>Logs</a></li>
              <li><a href="index.php?git=cikis"><span class="mif-exit icon"></span>Exit</a></li>
              <li class="divider"></li>
              <li><a href="index.php?git=kuralekle"><span class="mif-add icon"></span>Add Rule</a></li>
          <li><a href="index.php?git=ipekle"><span class="mif-add icon"></span>Add Blocked IP</a></li>
          <li><a href="index.php?git=methodekle"><span class="mif-add icon"></span>Add Method</a></li>
          </ul>
      </aside>
      <div class="shifted-content h-100 p-ab">
          <div class="app-bar pos-absolute bg-red z-1" data-role="appbar">
              <button class="app-bar-item c-pointer" id="sidebar-toggle-3">
                  <span class="mif-menu fg-white"></span>
              </button>
          </div>';
    } else {
      die("404");
    }
  }
  public function KontrolDosya($name) {
    if(file_exists("".$name."")) {
    } else {
    die("<center><b>PHP WAF Yüklenemedi / PHP WAF was not Installed</b>
    <hr></hr>
    <p>yukle.lock oluşturulmamış</b><br>
    <a href='install.php'>Yükle</a></center>");
    }
  }

  public function reel_ip()  
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
  public function Guncelleme() {
    $_SESSION["csrf"] = sha1(md5(rand()));
    $update = "http://alicangnll.github.io/aliwaf-phpwaf/";
    $json = file_get_contents("".$update."server_upd.json");
    $obj = json_decode($json, true);
    if(empty($obj["guncelleme_numarasi"])) {
      echo "<script>
      var notify = Metro.notify;
      notify.setup({
      width: 300,
      duration: 1000,
      animation: 'easeOutBounce'
      });
      
      document.write('<input type='hidden'>');
      notify.create('Versiyon Bilgisi Eksiktir!');
      notify.reset();
      </script>";
    } else {
      echo '<script>
      var data = "'.trim(file_get_contents("guncelleme.json")).'";
      var alert1 = "Sisteminiz günceldir.";
      var alert2 = "Sisteminiz için bir güncelleme bulunmaktadır.";
      var notify = Metro.notify;
      notify.setup({
        width: 300,
        duration: 1000,
        animation: "easeOutBounce"
      });
      var json = JSON.parse(data);
      if(json["guncelleme_kodu"] >= '.$obj["guncelleme_numarasi"].') {
        document.write("<input type="hidden">");
        notify.create(alert1);
        notify.reset();
      } else {
        document.write("<input type="hidden">");
        notify.create(alert2);
        notify.reset();
      }
      </script>';
    }
  }
  public function GetirHead() {
    echo '<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="pH Analyzer">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="css/metro-all.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script src="js/metro.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <title>pH Analyzer | AliWAF</title>  
    </head>';
  }
    public function CSS() {
        echo '<style>
        * {box-sizing: border-box;}
        
        .header {
          overflow: hidden;
          background-color: #f1f1f1;
          padding: 20px 10px;
        }
        
        .header a {
          float: left;
          color: black;
          text-align: center;
          padding: 12px;
          text-decoration: none;
          font-size: 18px; 
          line-height: 25px;
          border-radius: 4px;
        }
        
        .header a.logo {
          font-size: 25px;
          font-weight: bold;
        }
        
        .header a:hover {
          background-color: #ddd;
          color: black;
        }
        
        .header a.active {
          background-color: dodgerblue;
          color: white;
        }
        
        .header-right {
          float: right;
        }
        
        @media screen and (max-width: 500px) {
          .header a {
            float: none;
            display: block;
            text-align: left;
          }
          
          .header-right {
            float: none;
          }
        }
        body{
          margin: 0;
          font-family:Verdana,sans-serif;
          font-size:15px;
          line-height:1.5;
          font-family: Arial, Helvetica, sans-serif;
          color:black;
        }
        .simple-login-container{
            width:300px;
            max-width:100%;
            margin:50px auto;
        }
        .simple-login-container h2{
            text-align:center;
            font-size:20px;
        }
        
        .simple-login-container .btn-login{
            background-color:#FF5964;
            color:#fff;
        }
        a{
            color:black;
        }
        
        @media (max-width:800px) {
        body {
        margin: 0;
        font-size:14px;
        color:black;
        background-repeat: no-repeat;
        }
        .manzara {
          background-color: rgb(0,0,0); /* Fallback color */
          background-color: rgba(0,0,0, 0.4); /* Black w/opacity/see-through */
          color: white;
          font-weight: bold;
          text-align: center;
          padding: 15px;
        }
        .form-control {
          background-color: rgb(0,0,0); /* Fallback color */
          background-color: rgba(0,0,0, 0.4); /* Black w/opacity/see-through */
          color: white;
          box-shadow: 3px solid #f1f1f1;
          z-index: 2;
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          width: 100%;
        }
        }
        @media (min-width:800px) {
        body {
        background-repeat: no-repeat;
        }
        .manzara {
          background-color: rgb(0,0,0); /* Fallback color */
          background-color: rgba(0,0,0, 0.4); /* Black w/opacity/see-through */
          color: white;
          box-shadow: 3px solid #f1f1f1;
          z-index: 2;
          position: absolute;
          text-align: center;
          top: 50%;
          font-weight: bold;
          left: 50%;
          transform: translate(-50%, -50%);
          width: 100%;
        }
        .form-control {
          background-color: rgb(0,0,0); /* Fallback color */
          background-color: rgba(0,0,0, 0.4); /* Black w/opacity/see-through */
          color: white;
          box-shadow: 3px solid #f1f1f1;
          z-index: 2;
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          width: 100%;
        }
        
        .container  {
        border-radius: 20px;
        }
        
        }
        </style>';
    }
    public function DB_GetirWAFStatus() {
      $stmt = $this->aliwafpanel->prepare('SELECT * FROM waf_ayar WHERE waf_aktif = 1 ORDER BY ayar_id DESC');
      $stmt->execute();
      $getlog = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $json = json_encode($getlog);
      return $json;
    }

    public function DB_GetirWAFRules() {
      $stmt = $this->aliwafpanel->prepare('SELECT * FROM guard_watch ORDER BY kural_id DESC');
      $stmt->execute();
      $getlog = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $json = json_encode($getlog);
      return $json;
    }

    public function DB_GetirWAFAllowedMethods() {
      $stmt = $this->aliwafpanel->prepare('SELECT * FROM method_blok ORDER BY method_id DESC');
      $stmt->execute();
      $getlog = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $json = json_encode($getlog);
      return $json;
    }
    public function DB_GetirIPBan() {
      $stmt = $this->aliwafpanel->prepare('SELECT * FROM ip_ban ORDER BY ip_id DESC');
      $stmt->execute();
      $getlog = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $json = json_encode($getlog);
      return $json;
    }
    public function DB_GetirLoglar() {
      $stmt = $this->aliwafpanel->prepare('SELECT * FROM vuln_log ORDER BY id DESC');
      $stmt->execute();
      $getlog = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $json = json_encode($getlog);
      return $json;
    }
    public function DB_GetirAdmin() {
      $stmt = $this->aliwafpanel->prepare('SELECT * FROM admin_bilgi ORDER BY id DESC');
      $stmt->execute();
      $getlog = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $json = json_encode($getlog);
      return $json;
    }
    public function DB_SifirlaPassword() {
        $email = $_POST["email"];
        $token = sha1(md5($_POST["token"]));
        $stmt = $this->aliwafpanel->query("SELECT * FROM admin_bilgi WHERE email = ".$this->aliwafpanel->quote($email)." AND token = ".$this->aliwafpanel->quote($token)."");
        if ($stmt->rowCount() > 0) {
        $str = "0123456789";
        $str = str_shuffle($str);
        $str = substr($str, 0, 10);
        $password = sha1(md5($str));
        $this->aliwafpanel->query("UPDATE admin_bilgi SET passwd = ".$this->aliwafpanel->quote($password)." WHERE email = ".$this->aliwafpanel->quote($email)."");
        return true;
      } else {
        return false;
      }
  }

  public function DB_GetirIPBilgi($id) {
    $stmt = $this->aliwafpanel->prepare('SELECT * FROM ip_ban WHERE ip_id = :gonderid');
    $stmt->execute(array(':gonderid' => intval($id)));
    $getlog = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($getlog);
    return $json;
  }

  public function DB_InsertIP() {
    $update = $this->aliwafpanel->prepare("UPDATE ip_ban SET ip_adresi = :ipadresi  WHERE ip_id = :gonderid ");
    $update->bindValue(':gonderid', intval($_GET['id']));
    $update->bindValue(':ipadresi', strip_tags($_POST['ipadresi']));
    $update->execute();
    if($update){
      echo '<script>alert("Başarılı");window.location.replace("index.php?git=index")</script>';
    }
  }
  public function DB_GetirKural_ID() {
    $stmt = $this->aliwafpanel->prepare('SELECT * FROM guard_watch WHERE kural_id = :gonderid');
    $stmt->execute(array(':gonderid' => intval($_GET['id'])));
    $stmt->execute();
    $getlog = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($getlog);
    return $json;
  }

  public function DB_GetirAdmin_ID() {
    $stmt = $this->aliwafpanel->prepare('SELECT * FROM admin_bilgi WHERE id = :gonderid');
    $stmt->execute(array(':gonderid' => $_GET['id']));
    $stmt->execute();
    $getlog = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($getlog);
    return $json;
  }

  
  public function DB_GetirAyar_ID() {
    $stmt = $this->aliwafpanel->prepare('SELECT * FROM waf_ayar WHERE ayar_id = :gonderid');
    $stmt->execute(array(':gonderid' => "1"));
    $getlog = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($getlog);
    return $json;
  }

  public function DB_UpdateAyar() {
    $update = $this->aliwafpanel->prepare("UPDATE waf_ayar SET ayar_adi = :ayar_adi , waf_aktif = :waf_aktif , oto_ban = :oto_ban , ayar_aktif = :ayar_aktif, debug = :debug WHERE ayar_id = :gonderid ");
    $update->bindValue(':gonderid', strip_tags("1"));
    $update->bindValue(':ayar_adi', strip_tags($_POST['ayaradi']));
    $update->bindValue(':ayar_aktif', strip_tags($_POST['ayardurum']));
    $update->bindValue(':waf_aktif', strip_tags($_POST['wafdurum']));
    $update->bindValue(':oto_ban', strip_tags($_POST['otoban']));
    $update->bindValue(':debug', strip_tags($_POST['debug']));
    $update->execute();
    if($update){
      echo '<script>alert("Success");window.location.replace("index.php?git=index")</script>';
    }
  }

  public function DB_InsertRule() {
    $degis = str_replace(",", "¿¿", $_POST['kuralicerik']);
    $update = $this->aliwafpanel->prepare("INSERT INTO guard_watch(kural_adi, kural_icerik, kural_hakkinda) VALUES (:kuraladi, :kuralicerik, :kuralhk)");
    $update->bindValue(':kuraladi', $_POST['kuraladi']);
    $update->bindValue(':kuralhk', $_POST['kuraladi']);
    $update->bindValue(':kuralicerik', $degis);
    $update->execute();
    if($update){
      echo '<script>alert("Rule Added");window.location.replace("index.php?git=index")</script>';
    } else {
      echo '<script>alert("Rule Could Not Added");window.location.replace("index.php?git=index")</script>';
    }
  }

  public function DB_UpdateKural() {
    $degis = str_replace(",", "¿¿", strtolower($_POST['kuralicerik']));
    $update = $this->aliwafpanel->prepare("UPDATE guard_watch SET kural_adi = :kuraladi, kural_icerik = :kuralicerik, kural_hakkinda = :kuralhk WHERE kural_id = :gonderid ");
    $update->bindValue(':gonderid', strip_tags($_GET['id']));
    $update->bindValue(':kuraladi', strip_tags($_POST['kuraladi']));
    $update->bindValue(':kuralhk', strip_tags($_POST['kuraladi']));
    $update->bindValue(':kuralicerik', $degis);
    $update->execute();
    if($update){
      echo '<script>alert("Rule Updated");window.location.replace("index.php?git=index")</script>';
    } else {
      echo '<script>alert("Rule Could Not Updated");window.location.replace("index.php?git=index")</script>';
    }
  }
  public function DB_InsertKullanici() {
    $update = $this->aliwafpanel->prepare("UPDATE admin_bilgi SET kadi = :kadi , passwd = :pass , email = :email , token = :token WHERE id = :gonderid ");
    $update->bindValue(':gonderid', strip_tags($_GET['id']));
    $update->bindValue(':kadi', strip_tags($_POST['kadi']));
    $update->bindValue(':pass', strip_tags(sha1(md5($_POST['pass']))));
    $update->bindValue(':email', strip_tags($_POST['email']));
    $update->bindValue(':token', strip_tags(sha1(md5($_POST['tokens']))));
    $update->execute();
    if($update){
      echo '<script>alert("Başarılı");window.location.replace("index.php?git=index")</script>';
    }
  }
  public function DB_DuzenleMethod_ID() {
    $stmt = $this->aliwafpanel->prepare('SELECT * FROM method_blok WHERE method_id = :gonderid');
    $stmt->execute(array(':gonderid' => intval($_GET['id'])));
    $stmt->execute();
    $getlog = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($getlog);
    return $json;
  }
  public function DB_GuncelleMethod_ID() {
    $update = $this->aliwafpanel->prepare("UPDATE method_blok SET method_adi = :method_adi , method_turu = :method_turu WHERE method_id = :gonderid ");
    $update->bindValue(':gonderid', intval($_GET['id']));
    $update->bindValue(':method_adi', strip_tags($_POST['methodadi']));
    $update->bindValue(':method_turu', strip_tags($_POST['methodicerik']));
    $update->execute();
    if($update){
      echo '<script>alert("Başarılı");window.location.replace("index.php?git=index")</script>';
    }
  }
  public function DB_InsertIP_ID() {
    $update = $this->aliwafpanel->prepare("INSERT INTO ip_ban(ip_adresi, ip_usragent, ip_suresi) VALUES (:ipadresi, :ipusragent, :ipsure) ");
    $update->bindValue(':ipadresi', $_POST['ipadress']);
    $update->bindValue(':ipusragent', "panel");
    $update->bindValue(':ipsure', date('H:i:s'));
    $update->execute();
    if($update){
      echo '<script>alert("IP Added");window.location.replace("index.php?git=index")</script>';
    } else {
      echo '<script>alert("IP Could Not Added");window.location.replace("index.php?git=index")</script>';
    }
  }
  public function DB_InsertMethod() {
    $update = $this->aliwafpanel->prepare("INSERT INTO method_blok(method_adi, method_turu, method_bilgisi) VALUES (:methodadi, :methodicerik, :methodbilgi) ");
    $update->bindValue(':methodadi', $_POST['methodadi']);
    $update->bindValue(':methodbilgi', $_POST['methodadi']);
    $update->bindValue(':methodicerik', $_POST['methodicerik']);
    $update->execute();
    if($update){
      echo '<script>alert("Method Added");window.location.replace("index.php?git=index")</script>';
    } else {
      echo '<script>alert("Method Could Not Added");window.location.replace("index.php?git=index")</script>';
    }
  }
  public function DB_DeleteIP() {
    if(isset($_GET['ipsil'])){
      $stmt = $this->aliwafpanel->prepare('DELETE FROM ip_ban WHERE ip_id = :postID');
      $stmt->execute(array(':postID' => intval($_GET['ipsil'])));
      if($stmt){
        echo '<script>alert("IP Deleted");window.location.replace("index.php?git=index")</script>';
      } else {
        echo '<script>alert("IP Could Not Deleted");window.location.replace("index.php?git=index")</script>';
      }
    }
  }
  public function DB_DeleteRule() {
    if(isset($_GET['sil'])){ 
      $stmt = $this->aliwafpanel->prepare('DELETE FROM guard_watch WHERE kural_id = :postID');
      $stmt->execute(array(':postID' => intval($_GET['sil'])));
      if($stmt){
        echo '<script>alert("Rule Deleted");window.location.replace("index.php?git=index")</script>';
      } else {
        echo '<script>alert("Rule Could Not Deleted");window.location.replace("index.php?git=index")</script>';
      }
    }
  }
  public function DB_DeleteMethod() {
    if(isset($_GET['sil'])){
      $stmt = $this->aliwafpanel->prepare('DELETE FROM method_blok WHERE method_id = :postID');
      $stmt->execute(array(':postID' => intval($_GET['sil'])));
      if($stmt){
        echo '<script>alert("Method Deleted");window.location.replace("index.php?git=index")</script>';
      } else {
        echo '<script>alert("Method Could Not Deleted");window.location.replace("index.php?git=index")</script>';
      }
    }
  }
  public function Exit() {
    session_destroy();
    echo(" OK ");
    header("Location:index.php"); 
  }

}
?>
