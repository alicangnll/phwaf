<?php
ini_set('session.gc_maxlifetime', 1800); 
session_set_cookie_params(1800);
	require_once("baglanti.php");
	if($_POST)
	{
		if(empty($_POST["kadi"]) || empty($_POST["ksifre"]))  
           {  
                echo '<script>alert("Kullanıcı Adı/Şifre Boş Olamaz!");</script>';
                header('Location: index.php');  
           }  
           else  
           {  

		$name =$_POST["kadi"];
		$pass =sha1(md5($_POST['ksifre']));

		$query  = $db->query("SELECT * FROM kadi_giris WHERE kadi =" . $db->quote($name) . " && ksifre =" . $db->quote($pass) . "",PDO::FETCH_ASSOC);
		if ( $say = $query -> rowCount() ){
			if( $say > 0 ){
				session_start();
				session_regenerate_id();
				$_SESSION['oturum'] = time() + 1800;
				$_SESSION['oturum']=true;
				header('Location: ./waf_dosya/index.php');
				
			}else{
				echo "oturum açılmadı hata";
			}
		}else{
			header('Location: index.php');
		}
		   }
	}
?>
