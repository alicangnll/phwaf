<?php
function AlertKutusu($mesaj) {
    echo '<script type="text/javascript">alert("' . $mesaj . '")</script>';
}
function NoJSAlert($mesaj) {
    echo '<noscript>' . $mesaj . '</a></noscript>';
}
function CSSKutusu($mesaj) {
    echo '<link rel="stylesheet" type="text/css" href="' . $mesaj . '">';
}
   function rm_bosluk($buffer){ 
        return preg_replace('~>\s*\n\s*<~', '><', $buffer); 
   };
function JSKutusu($mesaj) {
	preg_replace(array("/\s+\n/","/\n\s+/","/ +/"),array("\n","\n "," "),$mesaj);
    echo '<script src="' . $mesaj . '"></script>';
}
function MetaKutusu($ad, $icerik) {
    echo '<meta name="' . $ad . '" content="' . $icerik . '" />';
} ?>
<?php 
JSKutusu("https://code.jquery.com/jquery-3.2.1.slim.min.js"); 
JSKutusu("https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.js"); 
JSKutusu("https://getbootstrap.com/docs/4.0/assets/js/docs.min.js"); 
//JS Girisi - 1 Bitti
CSSKutusu("https://cdnjs.cloudflare.com/ajax/libs/prism/1.15.0/themes/prism.css");  
CSSKutusu("../veri/css/style.css");  
CSSKutusu("../veri/css/main.css");
CSSKutusu("https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;subset=latin,latin-ext");
CSSKutusu("../veri/css/bootstrap.css"); 
//JS Girisi
JSKutusu("../veri/js/jquery-1.11.3.min.js");

ini_set('session.gc_maxlifetime', 1800); 
session_set_cookie_params(1800);
header("X-XSS-Protection: 1; mode=block");
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1);
require_once("baglanti.php");
echo '<meta name="robots" content="noarchive, noindex" />';
    session_start();
    if (isset($_SESSION['oturum'])){
			echo '<table>
	<tr>'
	?>
	<th><a class="btn btn-primary btn-md" href=" ../index.php">Ana Sayfa</a></th><br>
	<th><a class="btn btn-primary btn-md" href="../cikis.php">Çıkış</a></th><br>
	<th><a class="btn btn-primary btn-md" href="./waf_act/waf_ekle.php">Kural Ekle</a></th><br>
	<th><a class="btn btn-primary btn-md" href="./waf_act/waf_ipekle.php">IP Ekle</a></th><br>
	<th><a class="btn btn-primary btn-md" href="./waf_adm/adm_icerik.php">Adminler</a></th><br>
	<?php
	echo '</tr>
	</table>';
    }else {
        header('Location: ../index.php');  
    }
	?>
	<meta name="Description" content="<?php echo $_SERVER['SERVER_NAME']; ?> | WAF Guard">
<meta name="Keywords" content="<?php echo $_SERVER['SERVER_NAME']; ?> | WAF Guard">
<title><?php echo $_SERVER['SERVER_NAME']; ?> | WAF Guard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

