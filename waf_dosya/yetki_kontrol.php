<?php 

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
	<tr>
	<th><a href="cikis.php">Çıkış</a></th>
	<th><a href="waf_act/waf_ekle.php">Kural Ekle</a></th>
	<th><a href="waf_adm/adm_icerik.php">Adminler</a></th>
	</tr>
	</table>'; 
    }else {
        header('Location: ../index.php');  
    }
	?>
	<meta name="Description" content="<?php echo $_SERVER['SERVER_NAME']; ?> | WAF Guard">
<meta name="Keywords" content="<?php echo $_SERVER['SERVER_NAME']; ?> | WAF Guard">
<title><?php echo $_SERVER['SERVER_NAME']; ?> | WAF Guard</title>
